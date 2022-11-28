@extends('master')

@section ('title')
<title>ISDARE - Dashboard</title>
@endsection

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          
          <!-- Content Row -->
          <div class="row">
            @if(Auth::check() && Auth::user()->role_id == 1)
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employee Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$employee}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Leader Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$leader}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Activitivity Reports</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$act}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Activity Reports</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="card-body">
            <h4>Hello, welcome <b>{{Auth::user()->name}}</b>. You are logged in as <b>Admin</b>.</h4>
            </div>
          </div>
          
          @elseif(Auth::check() && Auth::user()->role_id == 2)

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-5 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Avg Efficiency</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$avg_effi}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-5 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Avg Competency</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$avg_comp}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-space-shuttle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Activities</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$act_emp}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Activities</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_emp}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          

          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="card-body">
            <h4>Hello, welcome <b>{{Auth::user()->name}}</b>. You are logged in as <b>Employee</b>.</h4>
            </div>
          </div>

          @elseif(Auth::check() && Auth::user()->role_id == 3)

          @if(!empty($act_lead))
          <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Best Avg Efficiency</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$effi->name}}</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$effi->avg_effi}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Best Avg Competency</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$comp->name}}</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$comp->avg_comp}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-space-shuttle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @else()
        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Best Avg Efficiency</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Best Avg Competency</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-space-shuttle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @endif()
          <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-5 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Reports</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$act_lead}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-5 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Reports</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_lead}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="card-body">
            <h4>Hello, welcome <b>{{Auth::user()->name}}</b>. You are logged in as <b>Leader</b>.</h4>
            </div>
          </div>

          @else

            @if(!empty($act_lead))
          <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Avg Efficiency</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$avg_effi}}</div>
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Best Avg Efficiency</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$effi->name}}</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$effi->avg_effi}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Avg Competency</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$avg_comp}}</div>
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Best Avg Competency</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$comp->name}}</div>
                      <div class="h7 mb-0 font-weight-bold text-gray-800">{{$comp->avg_comp}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-space-shuttle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @else()
        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Best Avg Efficiency</div>
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Avg Efficiency</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$avg_effi}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Best Avg Competency</div>
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Avg Competency</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$avg_comp}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-space-shuttle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @endif()

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Activities</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$act_emp}}</div>
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Reports</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$act_lead}}</div>
                        </div>
                      </div>
                      </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Actvities</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_emp}}</div>
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Reports</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_lead}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="card-body">
            <h4>Hello, welcome <b>{{Auth::user()->name}}</b>. You are logged in as <b>Employee & Leader</b>.</h4>
            </div>
          </div>

      @endif
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      @endsection