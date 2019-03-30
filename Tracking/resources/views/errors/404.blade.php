@extends('../layouts.errorslayout')
@section('content')

        <!-- page content -->

        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">404</h1>
              <h2>Sorry but we couldn't find this page</h2>
              <p>This page you are looking for does not exist 
              </p>
              <div class="mid_center">
                <form>
                  <div class="col-xs-12 form-group pull-right top_search">
                    <div class="">
                    <button action="action" onclick="window.history.go(-1); return false;" type="button" class=" btn btn-round btn-warning"> Go Back! </button>
                     
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        @endsection()