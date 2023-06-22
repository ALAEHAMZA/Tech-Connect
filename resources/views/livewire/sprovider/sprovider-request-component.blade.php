<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block !important ;
        }
    </style>

    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Your Requests</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Your Requests</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class="col-md-12 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            All Requests
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer</th>
                                                <th>Service</th>
                                                <th>Price</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $request )
                                                <tr>
                                                    <td>{{$request->id}}</td>
                                                    <td>{{$request->user->name}}</td>
                                                    <td>{{$request->service->name}}</td>
                                                    <td>{{$request->service->price}}</td>
                                                    <td>{{$request->created_at}}</td>
                                                    @if ($request->status === 'Waiting')
                                                        <td>
                                                            <a href="#" class="text-info" onclick='acceptConfirmation({{$request->id}})'>Accept</a>
                                                            <a href="#" class="text-danger" onclick='refuseConfirmation({{$request->id}})' style="margin-left:20px;">Refuse</a>
                                                        </td>
                                                    @else
                                                        <td class="text-black-50">Request {{$request->status}}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


{{-- Accept confirmation --}}
<div class="modal" id="acceptConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('assets/img/confirmation.png')}}"  height="90px" width="90px">
                        <h4 class="pb-3">Are you sure ?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle='modal' data-bs-target='#acceptConfirmation'>No</button>
                        <button type="button" class="btn btn-danger" onclick="acceptRequest()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function acceptConfirmation(id){
            @this.set('request_id',id);
            $('#acceptConfirmation').modal('show');
        }

        function acceptRequest(params) {
            @this.call('acceptRequest');
            $('#acceptConfirmation').modal('hide');

        }
    </script>
@endpush


{{-- Refuse confirmation --}}
<div class="modal" id="refuseConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('assets/img/confirmation.png')}}"  height="90px" width="90px">
                        <h4 class="pb-3 mt-10 ">Are you sure ?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle='modal' data-bs-target='#refuseConfirmation'>No</button>
                        <button type="button" class="btn btn-danger" onclick="refuseRequest()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function refuseConfirmation(id){
            @this.set('request_id',id);
            $('#refuseConfirmation').modal('show');
        }

        function refuseRequest(params) {
            @this.call('refuseRequest');
            $('#refuseConfirmation').modal('hide');

        }
    </script>
@endpush
