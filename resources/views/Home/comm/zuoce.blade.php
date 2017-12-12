      <aside class="dark-bg">
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-gears"></i>综合源</h2>
                     <ul class="sidebar-links">
                     @foreach($Vfirst as $v)
                        <li class="fa fa-chevron-right"><a href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a></li>
                     @endforeach
                     </ul>
                  </article>
                  <div class="clearfix spacer"></div>
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-hashtag"></i>今日热</h2>
                     <ul class="sidebar-links">
                     @foreach($tj as $v)
                        <li class="fa fa-chevron-right"><a href="{{url('home/play')}}?vid={{$v->vid}}">{{$v->vname}}</a></li>
                     @endforeach
                     </ul>
                  </article>
                  <div class="clearfix spacer"></div>
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-tag"></i>类&nbsp;目</h2>
                     <ul class="footer-tags">
                     @foreach($nav as $v)
                        <li class="fa fa-chevron-right"><a href="{{$v->resourceSrc}}">{{$v->nname}}</a></li>
                     @endforeach
                     </ul>
                  </article>
                 
                  <div class="clearfix spacer"></div>
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-plug"></i>上村淘</h2>
                     <!-- SUBSCRIBE FIELD -->
                   <a href="{{$oneAd['acontent']}}"> <img src="{{url('uploads/Ad')}}/{{$oneAd['aimg']}}" style="width: 160px; height: 100px;"></a>
                  </article>
               </aside>