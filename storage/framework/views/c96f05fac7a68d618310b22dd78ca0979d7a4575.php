<div ng-show="view=='fields'">
    <h4>Field Editor</h4>

    <table class="table">
        <thead>
        <tr>
            <th width="5%">Sort</th>
            <th width="25%">Variable</th>
            <th width="20%">Type</th>
           
            <th width="10%">Action</th>
        </tr>
        </thead>
        <tbody id="items">

        <tr     class="ng-class:field.field_activity"
                data-id="{% field.id %}"
                ng-repeat="field in data.segments[selectedSegmentId].selectedFields"
                ng-class="(field.id==activeFieldData.id) ? 'active' : ''">
            <td class="text-center"><i class="fa fa-arrows-v my-handle"></i></td>
            <td>{% field.field %}</td>
            <td>{% field.field_activity %}</td>
            
            <td><a href ng-click="setActiveField(field.id)">Edit &rarr;</a></td>
        </tr>

        </tbody>
    </table>

    <div ng-show="(data.segments[selectedSegmentId].selectedFields.length)==0">No Fields Defined</div>

    <div ng-show="data.segments[selectedSegmentId].selectedFields" class="form-group">
        <button type="button" ng-click="updateFields1()" class="btn btn-block btn-primary">SAVE FIELDS</button>
    </div>

</div>