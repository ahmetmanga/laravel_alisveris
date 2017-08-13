@extends('sayfa.home')
@section('title'){{$data->name}} -- Yorumlar @endsection
@section('degisken')
	<div class="col-md-12">
	<div class="panel panel-body">
				<h2 class="page-header text-primary">{{$data->name}}</h2>

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
				<td></td>
				<td>Ürün</td>
				<td>Fiyat</td>
				<td>Puan</td>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td><img src="{{$resim}}" width="50" height="50"></td>
					<td><a href="{{url('urun_detay')}}/{{$data->id}}" style="font-size:20px;">{{$data->name}}</a></td>
					<td><h4>{{$data->price}} ₺</h4></td>
					<td class="puan_renk">
						<h3 class="puan_renk">@for($i=0;$i<$data->ratings;$i++)
						<span class="glyphicon glyphicon-star"></span>
						@endfor
						@for($i=0;$i<5-$data->ratings;$i++)
						<span class="glyphicon glyphicon-star-empty"></span>
						@endfor</h3>
					</td>
				</tr>
			</tbody>
		</table>
		<h2 class="page-header text-primary">Yorumlar <span class="glyphicon glyphicon-chevron-right"></span></h2>
	</div>
			<div class="row">
			
				@foreach($yorumlar as $yorum)
                          	  
                               <div class="col-md-8 panel panel-body order" style="min-height:200px;margin-left:10%;margin-right:10%;">
                              
                               	 <div class="row">
                               	 	<div class="col-md-12">
                                   <div class="col-md-8">
                                   <h2> {{$yorum->yorum_baslik}}</h2>
                                 </div>
                                 
                                 <div class="col-md-4 puan_renk pull-right">
                                    	 @for($i=0;$i<$yorum->puan;$i++)
                                       <span class="glyphicon glyphicon-star"></span>
                                     @endfor
                                     @for($i=0;$i<5-$yorum->puan;$i++)
                                       <span class="glyphicon glyphicon-star-empty"></span>
                                     @endfor
                                 </div>
                              
                               	</div>
                               	 </div>
                                <br>
                               
                               		 {!!$yorum->yorum!!}
                               	

								
                                <hr>
                                <div class="col-md-12" style="color:#919191;">
                                  <span class="glyphicon glyphicon-user"></span> {{substr($yorum->user_id,0,strlen($yorum->user_id)/2)}} @for($i=0;$i<strlen($yorum->user_id)/2;$i++)*@endfor -  <span class="glyphicon glyphicon-time"></span> {{$yorum->created_at}}
                                 </div>
                               </div>
									
									
                                
                             @endforeach
                           <div class="sayfa_no" style="text-align:center;"></div>
			</div>
	
	</div>
	
@endsection