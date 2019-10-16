@extends('layouts.app-original', ['class'=>'page-screen-builder'])

@section('content')

    <div ng-app="myApp" ng-controller="myCtrl" class="angularBuilder">

        <div class="f f1" ng-show="view!='screens'">

            <h4>{% data.screen.name %}</h4>
            <small>{% data.screen.slug %}</small>

            <div class="btn-group btn-group-xs" role="group">
                <a class="btn btn-default" target="_blank" href="{{ getenv('APP_URL') }}{% data.screen.slug %}">View</a>
                <a class="btn btn-default" ng-click="view='screen'" href>Edit</a>
                <a class="btn btn-default" ng-click="changeScreen()" href>Select Other</a>
            </div>

            <hr />

            <h4>Segment Data</h4>

            <select ng-model="selectedSegmentId"
                    ng-change="selectedSegmentIdChanged()"
                    class="form-control input-sm "
                    ng-options="key as value for (key , value) in data.allSegments"></select>

            <div class="btn-group btn-group-xs" role="group">
                <a href class="btn btn-default" ng-click="createNewSegment()" ><i class="fa fa-plus-circle"></i> Create</a>
                <a href class="btn btn-default" ng-click="view='segment'">Edit</a>
            </div>

            <hr />

            <h4>Available Fields</h4>

            <div id="availableFields">
            <div ng-repeat="(key, field) in data.segments[selectedSegmentId].fields">
                <a href ng-click="selectField(key)">
                    <i class="ng-class:field.styling" ></i>
                    {% (field.name) ? field.name : key  %}</a>
            </div>
            </div>

            <a href title="This will remove current selection and add pre-defined fields and Submit button" class="btn btn-xs btn-default" ng-click="autoAddFields()">Add Everything</a>

            <div class="spacing"></div>

        </div>

        <!-- #2 -->

        <div class="f f2">

            @include('admin.screen-builder.partials.angular-builder-screens-editor')
            @include('admin.screen-builder.partials.angular-builder-screen-editor')
            @include('admin.screen-builder.partials.angular-builder-segment-editor')
            @include('admin.screen-builder.partials.angular-builder-fields-editor-new')

            <div class="spacing"></div>
        </div>

        <!-- SEGMENT #3 -->

        <div class="f f3"  ng-show="view!='screens'">

            <div ng-show="activeFieldData">
            <h4>Field Details</h4>

                <table class="table table-very-compact">
                    <tr>
                        <td><label>ID</label></td>
                        <td><input type="text" ng-model="activeFieldData.screenfield_id" readonly disabled class="form-control" /></td>
                    </tr>
                    <tr>
                        <td><label>Variable</label></td>
                        <td><input type="text" ng-model="activeFieldData.field" class="form-control" /></td>
                    </tr>
                    <tr>
                        <td><label>Field Type</label></td>
                        <td><input type="text" ng-model="activeFieldData.field_activity" class="form-control" /></td>
                    </tr>
                    <tr>
                        <td><label>Validation</label></td>
                        <td><input type="text" ng-model="activeFieldData.validation" class="form-control" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">META</td>
                    </tr>
                    <tr>
                        <td><label>Label</label></td>
                        <td>
                            <select ng-model="activeFieldData.label"
                                    class="form-control input-sm "
                                    ng-options="value as value for (key , value) in labels"></select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Href</label></td>
                        <td>
                            <select
                                    ng-model="activeFieldData.href"
                                    class="form-control input-sm">
                                <option ng-repeat="v in data.allScreens" value="{%v.id%}" title="{%v.name%}" ng-selected="{%v.value == activeFieldData.href%}">{%v.name%}</option>
                                </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>CSS</label></td>
                        <td><input type="text" ng-model="activeFieldData.class" class="form-control" /></td>
                    </tr>
                    <tr>
                        <td><label>HTML</label></td>
                        <td><textarea ng-model="activeFieldData.content" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" ng-click="saveFieldDeepCopy()" class="btn btn-block btn-success">Save</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" ng-click="setActiveField(null)" class="btn btn-block btn-default">Close</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" ng-click="destroyFieldDeepCopy()" class="btn btn-block btn-danger">Delete</button>
                        </td>
                    </tr>
                </table>

            </div>

            <div class="spacing"></div>
        </div>

        <div id="loading" ng-show="loading">Loading</div>

    </div>


    <script>
        screen = "";
        screenDataUrl = "{{ route('builder.angular.indexnew.get') }}";
        screensUrl = "{{ route('builder.angular.partial.indexnew.get') }}";
        saveScreenUrl = "{{ route('builder.angular.screen.post') }}";
        saveSegmentUrl = "{{ route('builder.screen-segment.post') }}";
        saveFieldsUrl = "{{ route('builder.angular.fields.post') }}";
        populateLabelsUrl = "{{ route('builder.angular.lang.get') }}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="{{ URL::asset('js/Sortable.min.js') }}"></script>
    <script src="{{ URL::asset('js/screen-builder-angular.js') }}"></script>

@endsection
