<div class="col-xs-6 col-md-4 sidebar" id="sidebar">
            <div class="sidebar-title for-tablet">Sidebar</div>
            <aside>
              <div class="aside-body">
                <div class="featured-author">
                  <div class="featured-author-inner">
                    <div class="featured-author-cover" style="background-image: url('/templates/blog/images/news/img15.jpg');">
                      <div class="badges">
                        <div class="badge-item"><i class="ion-star"></i> Featured</div>
                      </div>
                      <div class="featured-author-center">
                        <figure class="featured-author-picture">
                          <img src="{{asset('storage/app/media/files/myinfo/'.$objItemIntro->avatar)}}" alt="">
                        </figure>
                        <div class="featured-author-info">
                          <h2 class="name">{{$objItemIntro->name}}</h2>
                        </div>
                      </div>
                    </div>
                    <div class="featured-author-body">
                      <div class="featured-author-count">
                        <div class="item">
                          <a href="{{route('aboutme.abmindex.index')}}">
                            <div class="icon">
                              <div>My CV</div>
                              <i class="ion-chevron-right"></i>
                            </div>                            
                          </a>
                        </div>
                      </div>
                      <div class="featured-author-quote" style="font-family: 'Kaushan Script', cursive;">
                        "Dù người ta có nói với bạn điều gì đi nữa, hãy tin rằng cuộc sống là điều kỳ diệu và đẹp đẽ"
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
            <aside>
              <div class="aside-body">
                <div class="fb-page" data-href="https://www.facebook.com/ninhnghiait/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ninhnghiait/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ninhnghiait/">Facebook</a></blockquote></div>
              </div>
            </aside>
            <aside>
              <div class="aside-body">
                <figure class="ads">
                  <a href="single.html">
                    <img src="/templates/blog/images/ad.png">
                  </a>
                  <figcaption>Advertisement</figcaption>
                </figure>
              </div>
            </aside>
            <aside>
              <ul class="nav nav-tabs nav-justified" role="tablist">
                <li>
                  <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">
                    <i class="ion-ios-chatboxes-outline"></i> Comments
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane comments active" id="comments">
                  <div class="comment-list sm">
                    @foreach ($arFiveCmt as $vc)
                    @php
                    $id_cmt = $vc['id_cmt'];
                    $userCmt = $vc['id'] ? $vc['fullname'] : $vc['name'];
                    $avatar = $vc['avatar'] ? '/storage/app/media/files/users/'.$vc['avatar'] : '/templates/blog/images/users.png';
                    @endphp
                    <div class="item">
                      <div class="user">                                
                        <figure>
                          <img src="{{$avatar}}" alt="User Picture">
                        </figure>
                        <div class="details">
                          <h5 class="name" style="color: #4e4646; font-size: 16px;">{{$userCmt}}</h5>
                          <div class="time">{{date('d/m/Y', strtotime($vc['created_at']))}}</div>
                          <div class="description">
                            {{$vc['content']}}
                          </div>
                          <div><i class="ion ion-arrow-right-a"></i> <a href="{{route('aboutme.abmnews.detail',['slug' => str_slug($vc['nname']) , 'id' => $vc['id_news'] ])}}">{{$vc['nname']}}</a></div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </aside>
          </div>