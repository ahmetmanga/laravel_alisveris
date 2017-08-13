<div class="panel panel-default panel-body">
    <h2>Yorum Yap</h2>
    <hr>
    <form action="{{url('yorum_gonder')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="urun_id" value="{{$data->id}}">
        <input type="hidden" name="puan" value="0">
            <h2 class="puan_renk">@for($i=0;$i<5;$i++)<span class="glyphicon glyphicon-star-empty puanla"></span>@endfor</h2>
          <div class="form-group">
              <label>Yorum Başlığı:</label>
              <input type="text" class="input input-lg" name="yorum_baslik" placeholder="Yorum Başlığı">
          </div>
        <div class="form-group">
          <label>Yorumunuz:</label>
            <textarea name="yorum" class="input input-lg" rows="8" cols="50" placeholder="Yorumunuz"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary fulle btn-lg" name="button">Yorumu Gönder</button>
        </div>
    </form>
</div>
