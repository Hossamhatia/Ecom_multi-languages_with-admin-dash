@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الأقسام الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.vendors')}}">المتاجر الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"><a href=""> المتاجر
                                        </a> </li>
                                <li class="breadcrumb-item active"><a href=""> تعديل متجر </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع المتاجر  </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.errors')
                                @include('admin.includes.alerts.success')
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal ">
                                            <thead>
                                            <tr>
                                                <th> الاسم</th>
                                                <th>اللوجو</th>
                                                <th>الهاتف</th>
                                                <th>القسم الرئيسى </th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($vendors as $ven)
                                            <tr>
                                                <td>{{$ven->name}} </td>
                                                <td><img src="{{$ven->logo}}" style="width: 100px;height: 100px"></td>

                                                <td>{{$ven->mobile}}</td>
                                                <td>{{$ven->category->name}}</td>
                                                <td>{{$ven->getActive()}}</td>
                                                <td>
                                                    <div class="btn-group" role="group"
                                                         aria-label="Basic example">
                                                        <a href="{{route('edit.Vendor',$ven->id)}}"
                                                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                        <a href="{{route('delete.Vendor',$ven->id)}}"
                                                           class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف </a>
                                                        <a href="{{route('changeStatus.Vendor',$ven->id)}}"
                                                           class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @if($ven->active == 1)
                                                            الغاء تفعيل
                                                            @else
                                                             التفعيل
                                                                @endif

                                                        </a>


                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@endsection
