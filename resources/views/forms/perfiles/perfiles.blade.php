@extends('layouts2.app')
@section('titulo','Perfiles')

@section('main-content')
<br>
	<div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                      <li class="tab col s3" style="background-color: #78909c; color: #fff"><a class="white-text waves-effect waves-light active" href="#test1"><i class="mdi-action-perm-identity"></i>QUEUES</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#test2" class="white-text waves-effect waves-light"><i class="mdi-action-perm-identity"></i>Hotspot</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#test3" class="white-text waves-effect waves-light"><i class="mdi-action-perm-identity"></i>PPPoE</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#test4" class="white-text waves-effect waves-light"><i class="mdi-action-perm-identity"></i>PCQ</a>
                      </li>
                    </ul>
                    <div class="indicator" style="right: 1px; left: 402px;"></div><div class="indicator" style="right: 1px; left: 402px;"></div></ul>
                  </div>                  
                  <div class="col s12">
                    <div id="test1" class="col s12 tabs-mk" style="background-color: white">                    	
                      @include('forms.perfiles.lstQueues')                           
                    </div>
                    <div id="test2" class="col s12 tabs-mk" style="background-color: white">
                      @include('forms.perfiles.lstHotspot')   
                    </div>

                    <div id="test3" class="col s12 tabs-mk" style="background-color: white">
                      @include('forms.perfiles.lstPPPoE')   
                    </div>
                    <div id="test4" class="col s12 tabs-mk" style="background-color: white">
                      @include('forms.pcq.lstPCQ')   
                    </div>
  </div>                 
</div>

<br><br><br>
@endsection


