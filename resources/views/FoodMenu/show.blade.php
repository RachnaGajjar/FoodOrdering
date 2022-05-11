@extends('layout.admin')
@section('content')
<ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Organizations</a></li>
        <li class="breadcrumb-item">Show</li>
    </ol>

                                    <table id="dt-basic-example" class="table table-bordered table-hover w-100">
                                        <thead class="bg-warning-500">
                                            <tr>

                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Discription</th>
                                                <th>offer_avilable_for</th>
                                            </tr>
                                     </thead>
                                            <tbody>
                                                <tr>

                                                    <td>{{$foodmenu->name }}</td>
                                                    <td>{{$foodmenu->price }}</td>
                                                    <td>{{$foodmenu->discount}}</td>
                                                    <td>{{$foodmenu->discription}}</td>
                                                    <td>{{$foodmenu->offer_avilable_for}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>


<nav class="shortcut-menu d-none d-sm-block">
    <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
    <a href="dashboard.php" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
        <i class="fal fa-arrow-up"></i>
    </a>
</nav>
@endsection
