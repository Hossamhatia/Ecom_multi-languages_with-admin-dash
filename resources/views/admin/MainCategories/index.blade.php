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
                                <li class="breadcrumb-item"><a href="{{route('admin.MainCat')}}">الأقسام الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.MainCat')}}"> الأقسام
                                        </a> </li>
                                <li class="breadcrumb-item active"><a href="{{route('create.MainCat')}}"> إضافه قسم جديد</a>
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
                                    <h4 class="card-title">جميع الأقسام الرئيسية </h4>
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
                                                <th> اللغة</th>
                                                <th>الأختصار</th>
                                                <th>الحالة</th>
                                                <th>صورة القسم</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($Cat as $cat)
                                            <tr>
                                                <td>{{$cat->name}} </td>
                                                <td> {{$cat->translation_lang	}}</td>

                                                <td>{{$cat->getActive()}}</td>
                                                <td><img src="{{$cat->photo}}" style="width: 100px;height: 100px"></td>
                                                <td>
                                                    <div class="btn-group" role="group"
                                                         aria-label="Basic example">
                                                        <a href="{{route('edit.MainCat',$cat->id)}}"
                                                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                        <a href="{{route('delete.MainCat',$cat->id)}}"
                                                           class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف </a>
                                                        <a href="{{route('Status.MainCat',$cat->id)}}"
                                                           class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @if($cat->active ==0)
                                                                تفعيل
                                                            @else
                                                                ايقاف التفعيل
                                                            @endif</a>


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
