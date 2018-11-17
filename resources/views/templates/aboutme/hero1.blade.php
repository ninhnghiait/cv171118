<div class="hero-01">
          <div class="hero-border">
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="left"></div>
            <div class="right">
              <div class="v-area">
                <div class="v-middle show-span" >
                  <div class="p5" id="label-menu">
                    <span>M</span>
                    <span>Y</span>
                    <span></span>
                    <span>B</span>
                    <span>L</span>
                    <span>O</span>
                    <span>G</span>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="my-thumb">
            <div class="thumb-top"><a href="{{asset('storage/app/media/files/myinfo/'.$objItemIntro->avatar)}}" class="image-popup" title="This is Me."><img src="{{asset('storage/app/media/files/myinfo/'.$objItemIntro->avatar)}}" class="img-thumbnail no-radius"  alt=""></a></div>
          </div>

          <div class="content-hero">
            <div class="v-content" style="vertical-align: unset;padding-left: 0px;padding-right: 53px;">
              <nav id="sidebar">
                <!-- Sidebar Header -->
                <!-- Sidebar Links -->
                <ul class="list-unstyled components">
                  @if ($objItemsCat)
                  @foreach ($objItemsCat as $vc)
                    @if(isset($cid))
                      @php
                      $active = $vc['id_cat'] == $cid ? 'active' : '';
                      $active = $vc['id_cat'] == $getCatIdPr ? 'active' : $active;
                      $in = $vc['id_cat'] == $getCatIdPr ? 'in' : '';
                      @endphp
                    @else
                      @php
                      $active = '';
                      $in = '';
                      @endphp
                    @endif
                    @if (empty($vc['child']))
                    <li class="{{$active}}"><a href="{{route('aboutme.abmnews.cat',[ 'slug' => str_slug($vc['name']) , 'id' => $vc['id_cat'] ])}}">{{$vc['name']}}</a></li>
                    @else
                    <li class="{{$active}}"><!-- Link with dropdown items -->
                      <a href="#homeSubmenu{{$vc['id_cat']}}" data-toggle="collapse" aria-expanded="false">{{$vc['name']}}</a>
                      <ul class="collapse list-unstyled {{$in}}" id="homeSubmenu{{$vc['id_cat']}}">
                        @foreach ($vc['child'] as $vcc)
                        <li><a href="{{route('aboutme.abmnews.cat',[ 'slug' => str_slug($vcc['name']) , 'id' => $vcc['id_cat'] ])}}">{{$vcc['name']}}</a></li>
                        @endforeach
                      </ul>
                    </li>
                    @endif

                  @endforeach
                  @endif
                </ul>
                </nav>

              </div>
            </div>
        </div>