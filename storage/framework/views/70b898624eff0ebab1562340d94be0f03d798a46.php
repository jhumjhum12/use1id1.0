<div ng-show="view=='screens'">
    <h3>Screen Selector</h3>

    <div ng-repeat="(key, screen) in data.allScreens">
        <a href ng-click="changeScreen(screen.id)">{% screen.name %}</a>
    </div>

    <hr />

    <h4>Create new screen</h4>
    <div class="row">
        <div class="col-xs-4">
            <label>Screen Title</label>
            <input type="text" class="form-control" ng-model="newScreen.screen_title" />
        </div>
        <div class="col-xs-3">
            <label>URL</label>
            <input type="text" class="form-control" ng-model="newScreen.url_suffix" />
        </div>
        <div class="col-xs-3">
            <label>Parent Screen</label>
            <select ng-options="item as item.name for item in data.allScreens track by item.id"
                    ng-model="newScreen.parent_id"
                    class="form-control">
            </select>
        </div>
        <div class="col-xs-2">
            <label>&nbsp;</label>
            <button ng-click="updateScreen1(0)" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i> Create</button>
        </div>
    </div>


</div>