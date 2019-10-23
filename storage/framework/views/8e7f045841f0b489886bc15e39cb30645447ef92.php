<div ng-show="view=='screen'">
    <h4>Screen Editor</h4>

    <div class="form-group">
        <label>Screen Name</label>
        <input type="text" ng-model="activeScreenData.screen_title" class="form-control" />
    </div>
    <div class="form-group">
        <label>Label</label>
        <select ng-model="activeScreenData.field"
                class="form-control input-sm "
                ng-options="value as value for (key , value) in labels"></select>
    </div>
    <div class="form-group">
        <label>URL</label>
        <input type="text" ng-model="activeScreenData.url_suffix" class="form-control" />
    </div>
    <div class="form-group">
        <label>Parent Screen</label>
		<!--<input type="text" ng-model="activeScreenData.parent_id" class="form-control"/>-->
        <select ng-options="item as item.name for item in data.allScreens track by item.id"
                ng-model="activeScreenData.parent_id"
                class="form-control">
        </select>
    </div>
    <div class="form-group">
        <label>Status </label>
        <div class="radio-control">
            <label><input type="radio" ng-model="activeScreenData.is_active" ng-value="1"> Active</label>
        </div>
        <div class="radio-control">
            <label><input type="radio" ng-model="activeScreenData.is_active" ng-value="0"> Draft</label>
        </div>
        <div class="radio-control">
            <label><input type="radio" ng-model="activeScreenData.is_active" ng-value="-1"> Deleted</label>
        </div>
    </div>

    <div class="form-group">
        <label>Help: Video URL</label>
        <input type="text" ng-model="activeScreenData.help_video_url" class="form-control" />
    </div>

    <div class="form-group">
        <label>Help: Label</label>
        <select ng-model="activeScreenData.help_text"
                class="form-control input-sm "
                ng-options="value as value for (key , value) in labels"></select>
        </select>
    </div>

    <div class="form-group">
        <label>Help: Text (used if LABEL is not set)</label>
        <textarea ng-model="activeScreenData.help_html" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-success btn-block" ng-click="updateScreen1()">Update</button>
        <button class="btn btn-default btn-block" ng-click="view='fields'">Close</button>
    </div>
</div>