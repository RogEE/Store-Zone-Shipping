//
// Class to represent a row in the shipping rules grid
function ShippingRule(spec) {

    var self = this;

    self.description = ko.observable(spec.description || "");
    self.enabled = ko.observable(spec.enabled || false);

    self.regions = ko.observable(spec.regions || "");
    self.minQ = ko.observable(spec.minQ);
    self.maxQ = ko.observable(spec.maxQ);
    self.minT = ko.observable(spec.minT);
    self.maxT = ko.observable(spec.maxT);
    self.minW = ko.observable(spec.minW);
    self.maxW = ko.observable(spec.maxW);

    self.baseRate = ko.observable(spec.baseRate);
    self.perItemRate = ko.observable(spec.perItemRate);
    self.perWeightRate = ko.observable(spec.perWeightRate);
    self.percentRate = ko.observable(spec.percentRate);
    self.minRate = ko.observable(spec.minRate);
    self.maxRate = ko.observable(spec.maxRate);

    self.notes = ko.observable(spec.notes || "");

}

// Overall viewmodel for this screen, along with initial state

function RulesViewModel() {

    var self = this;

    self.rules = ko.observableArray([]);

    // Computed data

    self.totalCoverage = ko.computed(function() {
        var str = "";
        for (var i = 0; i < self.rules().length; i++)
            str = str + " + " + self.rules()[i].regions();
        return str;
    });

    // Operations

    self.addRule = function addRule() {
        self.rules.push(new ShippingRule({}));
    };

    self.removeRule = function removeRule(rule) {
        self.rules.remove(rule)
    };

    self.importRules = function importRules(newRules) {
        for (var i = 0; i < newRules.length; i++) {
            console.log(i);
            console.log(newRules[i]);
            self.rules.push(new ShippingRule(newRules[i]));
        }
    };

}

var rulesViewModel = new RulesViewModel();
ko.applyBindings(rulesViewModel);

if ($("#stored_rules_json").val() != "") {
    var parsed = JSON.parse( $("#stored_rules_json").val() );
    console.log(parsed);
    rulesViewModel.importRules(parsed.rules);
}