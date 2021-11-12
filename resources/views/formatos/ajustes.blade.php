@extends('home')
<link href="{{asset("assets/libs/magnific-popup/dist/magnific-popup.css")}}" rel="stylesheet"/>
@section('content')
<div class="row el-element-overlay">
    <div class="col-lg-3 col-md-6">
        <div class="card">
        <div class="el-card-item pb-3">
            <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
            <img src="../../assets/images/users/1-old.jpg" alt="user" class="d-block position-relative w-100"/>
            <div class="el-overlay w-100 overflow-hidden">
                <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                <li class="el-item d-inline-block my-0 mx-1">
                    <a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="../../assets/images/users/1-old.jpg">
                    <i data-feather="search" class="feather-sm"></i>
                    </a>
                </li>
                <li class="el-item d-inline-block my-0 mx-1">
                    <a class="btn default btn-outline el-link text-white border-white" href="javascript:void(0);">
                    <i data-feather="link" class="feather-sm"></i>
                    </a>
                </li>
                </ul>
            </div>
            </div>
            <div class="el-card-content text-center">
            <h4 class="mb-0">Oliver Abram</h4>
            <span class="text-muted">Graphics Designer</span>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
<script src="{{asset("assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("assets/libs/magnific-popup/meg.init.js")}}"></script>