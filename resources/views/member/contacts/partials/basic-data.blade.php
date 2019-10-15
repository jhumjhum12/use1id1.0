<div class="my-data-heading">
    <img class="img-circle" src="{{ $user->getImage() }}" width="120">
    &nbsp;
    <img src="{{ $user->getQRCode() }}" width="120" />

    <br /><br />
    <h1>{{ $user->first_name }} {{ $user->last_name }} </h1>
</div>



<table class="user-info-table">
        <tr>
            <td class="mydata-user">{{ Label::get('id') }}</td>
            <td>{{ $user->getPersonalId() }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('personal_id') }}</td>
            <td>{{ $user->personal_id }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('i_mail') }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('first_name') }}</td>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('last_name') }}</td>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('gender') }}</td>
            <td>{{ $user->getGender() }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('middle_name') }}</td>
            <td>{{ $user->middle_name }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('nickname') }}</td>
            <td>{{ $user->nickname }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('birthday') }}</td>
            <td>{{ $user->birthday }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('country_of_birth') }}</td>
            <td>{{ Label::getCountry($user->country_of_birth) }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('city_of_birth') }}</td>
            <td>{{ $user->place_of_birth }}</td>
        </tr>
        <tr>
            <td class="mydata-user">{{ Label::get('blood_type_group') }}</td>
            <td>{{ $user->getBloodType() }}</td>
        </tr>
        @if(isset($myOwn))
        <tr>
            <td class="mydata-user">{{ Label::get('selected_language') }}</td>
            <td>{{ $user->language->lang_txt }}</td>
        </tr>
        @endif
        <tr>
            <td class="mydata-user">{{ Label::get('address') }}</td>
            <td>{{ $user->street }} {{ $user->house_number }}<br />{{ $user->postal_code }} {{ $user->city }}</td>
        </tr>
    </table>