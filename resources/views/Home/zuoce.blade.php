      <aside class="dark-bg">
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-gears"></i>综合排行</h2>
                     <ul class="sidebar-links">
                     @foreach($Vfirst as $v)
                        <li class="fa fa-chevron-right"><a href="">{{$v->vname}}</a></li>
                     @endforeach
                     </ul>
                  </article>
                  <div class="clearfix spacer"></div>
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-hashtag"></i>rankings</h2>
                     <ul class="sidebar-links">
                     @foreach($Vfirst as $v)
                        <li class="fa fa-chevron-right"><a href="">{{$v->vname}}</a></li>
                     @endforeach
                     </ul>
                  </article>
                  <div class="clearfix spacer"></div>
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-tag"></i>tags</h2>
                     <ul class="footer-tags">
                     @foreach($Vfirst as $v)
                        <li class="fa fa-chevron-right"><a href="">{{$v->vname}}</a></li>
                     @endforeach
                     </ul>
                  </article>
                  <div class="clearfix spacer"></div>
                  <article class="reviews">
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-star"></i>top review</h2>
                     <!-- POST L size -->
                     <div class="post post-medium">
                        <a href="#" class="thumbr post-thumb">
                        <span class="review-number">4.8</span>
                        <img alt="Review" class="review img-responsive" src="img/thumbs/thumb-review7.jpg">
                        </a>
                        <div class="infor">
                           <h4>
                              <a href="#" class="title">Lazy Betty B*tch</a>
                           </h4>
                           <div class="ratings">
                              <i aria-hidden="true" class="fa fa-star"></i>
                              <i aria-hidden="true" class="fa fa-star"></i>
                              <i aria-hidden="true" class="fa fa-star-half-o"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-half"></i>
                           </div>
                        </div>
                     </div>
                  </article>
                  <div class="clearfix spacer"></div>
                  <article>
                     <h2 class="icon"><i aria-hidden="true" class="fa fa-plug"></i>subscribe</h2>
                     <!-- SUBSCRIBE FIELD -->
                     <form id="subscribe-submit" action="#" method="post" name="search-submit">
                        <fieldset class="search-fieldset">
                           <input type="text" value="" placeholder="Your email address" class="search-field" size="12" name="search" id="subscribe">
                           <button title="Subscribe" type="submit" class="subscribe-btn">Subscribe</button>
                        </fieldset>
                     </form>
                  </article>
               </aside>