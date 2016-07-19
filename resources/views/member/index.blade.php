@extends('app')


@section('content')

@section('steps-menu')

    @include('partials.navsteps')

@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    Members Listing &nbsp;

                    {!! link_to("member/create", '', array('class'=>'fa fa-plus')) !!}
                </div>
                <div class='panel-body'>
                    <table class='table table-hover'>
                        <tr><th>Name</th><th>Title</th><th>Actions</th></tr>

                        @if(isset($members))

                            @foreach ($members as $member)
                                <tr>
                                    <td>
                                        {!! $member->name !!}
                                    </td>
                                    <td>
                                        {!! $member->address !!}
                                    </td>

                                    <td>
                                        {!! link_to("member/edit/$member->id", '', array('class'=>'fa fa-pencil-square-o')) !!}
                                        {!! link_to("member/delete/$member->id", '', array('class'=>'fa fa-trash')) !!}
                                    </td>
                                </tr>
                            @endforeach

                        @endif

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



@stop





