@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.MainCat')}}">الأقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.MainCat')}}"> الأقسام </a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('create.MainCat')}}">تعديل -{{$mainCategory->name}} </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل  قسم </h4>
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
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('update.MainCat',$mainCategory->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="{{$mainCategory->photo}}"
                                                        class="rounded-circle height-150" alt="صورة القسم الحالى">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>صورة القسم</label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="hidden" name="id" value="{{$mainCategory->id}}">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> تعديل  قسم رئيسى </h4>


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم - {{__('messages.'.$mainCategory->translation_lang)}} </label>
                                                                    <input type="text"  id="name"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           value="{{$mainCategory->name}}"
                                                                           name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اختصار اللغه - {{__('messages.'.$mainCategory->translation_lang)}}</label>
                                                                    <input type="text" value="{{$mainCategory->translation_lang}}" id="abbr"
                                                                           class="form-control"
                                                                           placeholder=""
                                                                           name="category[0][abbr]">
                                                                    @error("category.0.abbr")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="switcheryColor4"
                                                                               class="card-title "> الحالة - {{__('messages.'.$mainCategory->translation_lang)}} </label>
                                                                        <input type="checkbox" name="category[0][active]"
                                                                               value="1"
                                                                               id="switcheryColor4"
                                                                               class="switchery" data-color="success"
                                                                              @if($mainCategory->active ==1) checked @endif/>
                                                                      <!-- <input type="hidden" name="category[0][active]" value="0">-->

                                                                        @error("category.0.active")
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                        <i class="ft-x"></i> تراجع
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> حفظ
                                                    </button>
                                                    <br/>

                                            </div>
                                            </div>
                                        </form>
                                        <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                            @isset($mainCategory->categoriess)
                                                @foreach( $mainCategory->categoriess as $index => $main_cat)

                                            <li class="nav-item">
                                                <a class="nav-link @if($index == 0)active @endif " id="home-tab1" data-toggle="tab" href="#home1{{$index}}" aria-controls="home1"
                                                   aria-expanded="true">{{$main_cat->translation_lang}}</a>
                                            </li>
                                                @endforeach
                                                @endisset

                                        </ul>
                                        <div class="tab-content px-1 pt-1" >
                                            @isset($mainCategory->categoriess)
                                                @foreach( $mainCategory->categoriess as $index => $main_cat)

                                                <div role="tabpanel" class="tab-pane @if($index == 0)active @endif "  id="home1{{$index}}" aria-labelledby="home-tab1" aria-expanded="true">
                                                <form class="form" action="{{route('update.MainCat',$main_cat->id)}}" method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <label id="projectinput7" class="file center-block">
                                                        <input type="hidden" name="id" value="{{$main_cat->id}}">

                                                        <span class="file-custom"></span>
                                                    </label>



                                                    <div class="form-body">
                                                        <h4 class="form-section"><i class="ft-home"></i> تعديل لغات القسم رئيسى </h4>


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم - {{__('messages.'.$main_cat->translation_lang)}} </label>
                                                                    <input type="text"  id="name"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           value="{{$main_cat->name}}"
                                                                           name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اختصار اللغه - {{__('messages.'.$main_cat->translation_lang)}}</label>
                                                                    <input type="text" value="{{$main_cat->translation_lang}}" id="abbr"
                                                                           class="form-control"
                                                                           placeholder=""
                                                                           name="category[0][abbr]">
                                                                    @error("category.0.abbr")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group ">
                                                                        <label for="switcheryColor4"
                                                                               class="card-title "> الحالة - {{__('messages.'.$main_cat->translation_lang)}} </label>
                                                                        <input type="checkbox" name="category[0][active]"
                                                                               value="1"
                                                                               id="switcheryColor4"
                                                                               class="switchery" data-color="success"
                                                                               @if($main_cat->active ==1) checked @endif/>
                                                                        <!-- <input type="hidden" name="category[0][active]" value="0">-->

                                                                        @error("category.0.active")
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-actions">
                                                            <button type="button" class="btn btn-warning mr-1"
                                                                    onclick="history.back();">
                                                                <i class="ft-x"></i> تراجع
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="la la-check-square-o"></i> حفظ
                                                            </button>
                                                            <br/>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>


@endsection
