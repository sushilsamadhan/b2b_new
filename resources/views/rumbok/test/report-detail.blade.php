@extends('rumbok.app')

@section('content')

<!--======================================
          START breadcrumb AREA
  ======================================-->
<style>
    
    .scroller {
        text-align: center;
        cursor: pointer;
        display: none;
        padding: 7px;
        padding-top: 11px;
        white-space: no-wrap;
        vertical-align: middle;
        background-color: #fff;
    }

    .scroller-right {
        float: right;
    }

    .scroller-left {
        float: left;
    }

    .answer-option {
        margin-bottom: 10px;
    }

</style>


<!--======================================
            END breadcrumb AREA
    ======================================-->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!--======================================
            START COURSE AREA
    ====================================== padding-top-80px padding-bottom-120px-->
<section class="heading-n-breadcrub-part">
  <div class="container">
      <div class="row">
          <div class="col-lg-10">
              <div class="title-page">
              <h1>{{ $packageDetail->pkg_name }} Practice Test</h1>
              </div>              
          </div>
          <div class="col-lg-2">
              <div class="clearfix">
                  @if($mockTestEnrollment->test_type == 'subject')
                  <a href="{{ route('subject-test-package' ,[$packageDetail->id]) }}" type="botton" class="btn btn-danger">View Reports</a>
                  @elseif($mockTestEnrollment->test_type == 'unit')
                  <a href="{{ route('unit-test-package' ,[$packageDetail->id]) }}" type="botton" class="btn btn-danger">View Reports</a>
                  @else
                  <a href="{{ route('chapter-test-package' ,[$packageDetail->id]) }}" type="botton" class="btn btn-danger">View Reports</a>
                  @endif
              
                  <!-- <ul class="bread-crumb-part-list">
                      <li>
                          <a href="https://ole.org.in">Home</a>
                      </li>
                      <li><span>Board CBSE</span></li>
                  </ul> -->
              </div>
          </div>
       </div>
  </div>
</section>

<section class="clearfix">
    <div class="container">
        {{-- sidebar --}}
        <div class="row" id="product-gallery-holder-2222">
            @include('rumbok.test.component.report-test-start-filter')            
        </div>
    </div>
</section>
<!--======================================
            END COURSE AREA
    ======================================-->
@endsection

@section('js')
<script type="text/javascript">


    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function() {
        var itemsWidth = 0;
        $('.list li').each(function() {
            var itemWidth = $(this).outerWidth();
            itemsWidth += itemWidth;
        });
        return itemsWidth;
    };

    var widthOfHidden = function() {
        return (($('.wrapper').outerWidth()) - widthOfList() - getLeftPosi()) - scrollBarWidths;
    };

    var getLeftPosi = function() {
        return $('.list').position().left;
    };

    var reAdjust = function() {
        if (($('.wrapper').outerWidth()) < widthOfList()) {
            $('.scroller-right').show();
        } else {
            $('.scroller-right').hide();
        }

        if (getLeftPosi() < 0) {
            $('.scroller-left').show();
        } else {
            $('.item').animate({
                left: "-=" + getLeftPosi() + "px"
            }, 'slow');
            $('.scroller-left').hide();
        }
    }

    reAdjust();
    $(window).on('resize', function(e) {
        reAdjust();
    });

    $('.scroller-right').click(function() {

        $('.scroller-left').fadeIn('slow');
        $('.scroller-right').fadeOut('slow');

        $('.list').animate({
            left: "+=" + widthOfHidden() + "px"
        }, 'slow', function() {

        });
    });

    $('.scroller-left').click(function() {

        $('.scroller-right').fadeIn('slow');
        $('.scroller-left').fadeOut('slow');

        $('.list').animate({
            left: "-=" + getLeftPosi() + "px"
        }, 'slow', function() {

        });
    });

</script>
@endsection