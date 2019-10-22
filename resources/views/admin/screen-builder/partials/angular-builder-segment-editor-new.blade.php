<div ng-show="view=='segment'">
    <h4>Segment Editor {% activeSegmentData.segment_id %}</h4>

    <div class="form-group">
        <label>Segment Name</label>
        <input type="text" ng-model="activeSegmentData.name" class="form-control" />
    </div>
    <div class="form-group">
        <label>Data Model</label>
        <select ng-options="key as value for (key , value) in data.allModels"
                ng-model="activeSegmentData.model"
                class="form-control">
        </select>
    </div>
    <div class="form-group">
        <label>Action to be taken (create_or_update)</label>
        <input type="text" ng-model="activeSegmentData.action" class="form-control" />
    </div>
    <div class="form-group">
        <label>Status </label>
        <div class="radio-control">
            <label><input type="radio" ng-model="activeSegmentData.status" ng-value="1"> Active</label>
        </div>
        <div class="radio-control">
            <label><input type="radio" ng-model="activeSegmentData.status" ng-value="-1"> Deleted</label>
        </div>
    </div>
    <div class="form-group">
        <label>Sort</label>
        <input type="text" ng-model="activeScreenData.sort"  class="form-control" />
    </div>
    <div class="form-group">
        <button class="btn btn-success btn-block" ng-click="updateSegment()">Update</button>
        <button class="btn btn-default btn-block" ng-click="view='fields'">Close</button>
    </div>
</div>