@php
     $populer = App\Helpers\FunctionHelper::artikelPopuler(5);
     $kategori = App\Helpers\FunctionHelper::kategori();
@endphp
<div class="widget-area">
     <div class="recent-posts mb-50">
          <h3 class="widget-title">BERITA POPULER</h3>
          <ul>
               @foreach($populer as $val)
                    <li>
                         <a href="{{ url('artikel/'.$val->id.'-'.$val->judul_slug) }}" title="{{ $val->judul }}">
                              {{ $val->get_judulartikel35 }}
                         </a>
                    </li>
               @endforeach
          </ul>
     </div> 
     <div class="widget-archives mb-50">
          <h3 class="widget-title">KATEGORI</h3>
          <ul>
               @foreach($kategori as $val)
                    <li>
                         <a href="{{ url('kategori/'.$val->id) }}">{{$val->name}}</a> 
                    </li>
               @endforeach
          </ul>
     </div>
</div>