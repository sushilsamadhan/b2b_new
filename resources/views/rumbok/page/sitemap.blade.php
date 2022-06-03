
@extends('rumbok.app')
@section('content')



{{--<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sitemap : Olexpert</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/minty/bootstrap.min.css">--}}
  
  <link rel="stylesheet" href="{{asset('asset_rumbok/new/tree/listree.min.css')}}"/>
  


{{--</head>
<body>--}}
<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h3>Sitemap</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        
        <div class="card-body">



        <!-- board  -->
         <ul class="listree p-0 pb-0 mb-0 border-bottom border-dark">
          <li>
            <div class="listree-submenu-heading1 text-dark h5">
                @translate(Board)
            </div>
            <ul class="listree">
                    @foreach(categories() as $item)
                    @if (($item->is_compitative == '0') && ($item ->is_free_study != '1') &&
                    ($item ->is_current_affairs != '1') && ($item ->is_project_works != '1') && ($item ->id != '84'))
                    @if($item->name!='Blog')
                <li>
                    <div class="listree-submenu-heading1 text-dark">{{$item->name}}</div>
                   
                    
                    <ul class="listree-submenu-items-1 p-2 pb-2 mb-2">
                    @if($item->child->count() != 0)
                    @foreach($item->child as $child)
                    <li class="inline">
                        <a class="box font-weight-normal small" href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                    </li>
                    @endforeach
                    @endif
                    </ul>
                   
                </li>

                    @endif
                @endif
                @endforeach
                
            </ul>
          </li>
        </ul> 

        

<!-- Competitive -->
        <ul class="listree p-0 pb-4 mb-4 border-bottom border-dark">
          <li>
            <div class="listree-submenu-heading1 text-dark h5">
                @translate(Competitive)</div>         
                
                   
                <ul class="listree">
                  @foreach(categories() as $item)
                          @if ($item->is_compitative != '0')     
                          <li class="inline">                
                                  <a class="box font-weight-normal small" href="{{route('competitive.curriculum',$item->slug)}}">{{$item->name}} </a>
                              
                              </li>                 
                              @endif
                          @endforeach
               
                </ul>
            
                
          </li>
        </ul>


<!-- (Study Material) -->

        <ul class="listree p-0 pb-4 mb-4 border-bottom border-dark">
          <li>
            <div class="listree-submenu-heading1 text-dark h5">
                 @translate(Study Material)
                </div>
            <ul class="listree">

            @foreach(categories() as $item)
             @if ($item->is_free_study != '0')
             <li class="inline">              
                    <a class="box font-weight-normal small" href="{{route('list_freestudy_courses',$item->slug)}}">{{$item->name}}</a>                                                     
                
                 </li>

                 @endif
                   @endforeach
                
            </ul>
          </li>
        </ul> 



        <!-- (Our Elite Courses) -->

        <ul class="listree p-0 pb-4 mb-4 border-bottom border-dark">
          <li>
            <div class="listree-submenu-heading1 text-dark h5">@translate(Our Elite Courses)</div>
           
                
                <ul class="listree">

                <li class="inline">
                        <a class="box font-weight-normal small" href="{{route('project_work')}}">Project Work</a>
                                                              
                </li> 

                @foreach(categories() as $item)
                @if ($item->is_project_works != '0')
                
                <li class="inline">
                    <a class="box font-weight-normal small" href="{{route('course.elite',$item->slug)}}">{{$item->name}} </a>
                   
                    @if($item->child->count() != 0)  
                    <ul class="listree-submenu-items">
                    @foreach($item->child as $child)
                    
                    <li class="inline">
                    <a class="box font-weight-normal small" href="{{route('course.elite',$child->slug)}}">{{$child->name}}</a>                                                    
                    </li>
                        @endforeach
                      
                        </ul>
                        @endif
                    </li>
                    @endif
                     @endforeach
                    </ul>
                
          </li>
        </ul>


        <!-- other -->

        <ul class="listree p-0 pb-4 mb-4 ">
          <li>
            <div class="listree-submenu-heading1 text-dark h5">
                 @translate(other)
                </div>
            <ul class="listree">
                          <!-- current affairs -->
                          <li class="inline">
                             
           
                               <a class="box font-weight-normal small" href="{{url('current-affairs')}}">
                                  @translate(Current Affairs)
                                           <!-- <i class="fa fa-chevron-down"></i> -->
                                 </a>         
          
                           </li>
                          <!-- test series -->
                          @auth
                          @if (Auth::user()->user_type === "Student")
                          <li class="inline">
                              
                              <a  class="box font-weight-normal small" href="{{url('test-series')}}">@translate(Test Series)</a>
                            
                            </li>
                            @else
                            <li class="inline">
                              
                              <a class="box font-weight-normal small"  href="{{url('test-series-login')}}">@translate(Test Series)</a>
                          
                            </li>
                            @endif
                            @endauth
                        @guest
                        <li class="inline">
                        <a class="box font-weight-normal small" href="{{url('test-series-login')}}">@translate(Test Series)</a>
                        </li>
                      @endguest
            </ul>
          </li>
        </ul>

        


<!-- 

        <ul class="listree p-0 m-0">
          <li>
           
            <a href="{{url('current-affairs')}}">
                                            @translate(Current Affairs)
                                           {{-- <i class="fa fa-chevron-down"></i>--}}     </a>
            
           
          </li>
        </ul>







        
        <ul class="listree p-0 m-0">

        @auth
         @if (Auth::user()->user_type === "Student")
          <li>
            
            <a href="{{url('test-series')}}">@translate(Test Series)</a>
           
          </li>
          @else
          <li>
            
            <a href="{{url('test-series-login')}}">@translate(Test Series)</a>
         
          </li>
          @endif
          @endauth
            @guest
          <li>
            <a href="{{url('test-series-login')}}">@translate(Test Series)</a>
            </li>
          @endguest
        </ul> -->


        </div>
      </div>
    </div>
  </div>
</div>



{{--</body>--}}
<script src="{{asset('asset_rumbok/new/tree/listree.umd.min.js')}}"></script>
  <script>
        listree();
    </script>
{{--</html>--}}





    
@endsection