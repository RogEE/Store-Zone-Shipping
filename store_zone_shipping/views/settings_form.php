<h3>Shipping Rules</h3>
<p>(<span data-bind="text: rules().length"></span> rules currently defined)</p>

<hr>

<table class="szs_table">
    <thead><tr>
        <th>Enabled</th><th>Description</th><th>Filters</th><th>Charges</th><th>Notes</th><th></th>
    </tr></thead>
    <tbody data-bind="foreach: rules">
    <tr class="szs_rule_row">
        <td class="szs_rule_col"><input type="checkbox" data-bind="checked: enabled"></td>
        <td class="szs_rule_col"><input data-bind="value: description" /></td>
        <td class="szs_rule_col">
            <table>
            <tr><td><label>Regions</label></td><td><textarea data-bind="value: regions" /></textarea></td></tr>
            <tr><td><label>Min Items</label></td><td><input data-bind="value: minQ" /></td></tr>
            <tr><td><label>Max Items</label></td><td><input data-bind="value: maxQ" /></td></tr>
            <tr><td><label>Min Total</label></td><td><input data-bind="value: minT" /></td></tr>
            <tr><td><label>Max Total</label></td><td><input data-bind="value: maxT" /></td></tr>
            <tr><td><label>Min Weight (g)</label></td><td><input data-bind="value: minW" /></td></tr>
            <tr><td><label>Max Weight (g)</label></td><td><input data-bind="value: maxW" /></td></tr>
            </table>
        </td>
        <td class="szs_rule_col">
            <table>
            <tr><td><label>Base Rate</label></td><td><input data-bind="value: baseRate" /></td></tr>
            <tr><td><label>Per Item Rate</label></td><td><input data-bind="value: perItemRate" /></td></tr>
            <tr><td><label>Per g Rate</label></td><td><input data-bind="value: perWeightRate" /></td></tr>
            <tr><td><label>% Order Total</label></td><td><input data-bind="value: percentRate" /></td></tr>
            <tr><td><label>Min Rate</label></td><td><input data-bind="value: minRate" /></td></tr>
            <tr><td><label>Max Rate</label></td><td><input data-bind="value: maxRate" /></td></tr>
            </table>
        </td>
        <td class="szs_rule_col">
            <textarea data-bind="value: notes"></textarea></button>
        </td>
        <td class="szs_rule_col">
            <button data-bind="click: $root.removeRule">- Delete</button>
        </td>
    </tr>
    </tbody>
</table>

<button data-bind="click: addRule, enable: rules().length < 10">+ Add a rule</button>

<!--
<p data-bind="visible: totalCoverage()">
    <strong>Region coverage:</strong> <span data-bind="text: totalCoverage()"></span>
</p>
-->

<textarea name="stored_rules_json" id="stored_rules_json" style="display:none !important;">
    <?=$rules_json?>
</textarea>

<hr>


<?=form_open('C=addons_extensions'.AMP.'M=save_extension_settings'.AMP.'file=store_zone_shipping');?>
<textarea name="rules_json" id="rules_json" data-bind="value: ko.toJSON($root, null, 2)" style="display:none !important;"></textarea>
<p><?=form_submit('submit', "Save Settings", 'class="submit"')?></p>
<?=form_close()?>