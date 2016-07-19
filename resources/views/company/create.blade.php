@extends('app')


@section('content')

    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-8 col-md-offset-2'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>New Company</div>
                    <div class='panel-body'>


                        {!! Form::open(array('url' => 'company/store', 'method' => 'post', 'class'=>'form-horizontal')) !!}

                        @include('company._form',['submitButtonText' => 'Create'])



                        <hr>
                        <table class='table table-hover'>
                            <tr><th>#</th><th>Name</th><th>Title</th></tr>

                            @if(isset($members))

                                @foreach ($members as $member)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="members[]" value="{{$member->id}}" class="chk_media"  >
                                        </td>
                                        <td>
                                            {!! $member->name !!}
                                        </td>
                                        <td>
                                            {!! $member->address !!}
                                        </td>


                                    </tr>
                                @endforeach

                            @endif

                        </table>

                        {!! Form::close() !!}

                        <hr>
                        <h3>Report</h3>

                        @if(isset($companies ))
                            <table class='table table-hover'>
                                <tr><th>Company Name</th><th>Members</th></tr>

                            @foreach ($companies as $company)
                                <tr>

                                    <td>
                                        {!! $company->name !!}
                                    </td>
                                    <td>
                                        @foreach ($company->members as $co_member)
                                            <li>{!! $co_member->name !!}</li>
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach

                           </table>

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>




@stop


    