<div>
    <x-partials.breadcrumb :title="__('article')" :last="$article->title" />

    <div class="blog-section detail">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-3">
                    {{-- Start Sidebar Area --}}
                    <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                        {{-- Start Single Sidebar Widget --}}
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Search</h6>
                            <div class="default-search-style d-flex">
                                <input class="default-search-style-input-box" type="search" placeholder="Search..."
                                    required>
                                <button class="default-search-style-input-btn" type="submit"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div> {{-- End Single Sidebar Widget --}}

                        {{-- Start Single Sidebar Widget --}}
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">CATEGORIES</h6>
                            <div class="sidebar-content">
                                <ul class="sidebar-menu">
                                    <li><a href="#">Audio</a></li>
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Gallery</a></li>
                                    <li><a href="#">Other</a></li>
                                    <li><a href="#">Travel</a></li>
                                    <li><a href="#"> Uncategorized</a></li>
                                    <li><a href="#"> Video</a></li>
                                    <li><a href="#">Wordpress</a></li>
                                </ul>
                            </div>
                        </div> {{-- End Single Sidebar Widget --}}

                        {{-- Start Single Sidebar Widget --}}
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Tags</h6>
                            <div class="sidebar-content">
                                <div class="tag-link">
                                    <a href="#">Technology</a>
                                    <a href="#">Information</a>
                                    <a href="#">Wordpress</a>
                                    <a href="#">Devs</a>
                                    <a href="#">Program</a>
                                </div>
                            </div>
                        </div> {{-- End Single Sidebar Widget --}}

                        {{-- Start Single Sidebar Widget --}}
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Meta</h6>
                            <div class="sidebar-content">
                                <ul class="sidebar-menu">
                                    <li><a href="#">Log in</a></li>
                                    <li><a href="#">Entries feed</a></li>
                                    <li><a href="#">Comments feed</a></li>
                                    <li><a href="#">WordPress.org</a></li>
                                </ul>
                            </div>
                        </div> {{-- End Single Sidebar Widget --}}

                        {{-- Start Single Sidebar Widget --}}
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">PRODUCT CATEGORIES</h6>
                            <div class="sidebar-content">
                                <ul class="sidebar-menu">
                                    <li>
                                        <ul class="sidebar-menu-collapse">
                                            {{-- Start Single Menu Collapse List --}}
                                            <li class="sidebar-menu-collapse-list">
                                                <div class="accordion">
                                                    <a href="shop-grid-sidebar-left.html"
                                                        class="accordion-title collapsed" data-bs-toggle="collapse"
                                                        data-bs-target="#men-fashion" aria-expanded="false">Men <i
                                                            class="ion-ios-arrow-right"></i></a>
                                                    <div id="men-fashion" class="collapse">
                                                        <ul class="accordion-category-list">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Jackets &amp; Coats</a></li>
                                                            <li><a href="#">Sweaters</a></li>
                                                            <li><a href="#">Jeans</a></li>
                                                            <li><a href="#">Blouses &amp; Shirts</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li> {{-- End Single Menu Collapse List --}}
                                        </ul>
                                    </li>
                                    <li><a href="#">Football</a></li>
                                    <li><a href="#"> Men's</a></li>
                                    <li><a href="#"> Portable Audio</a></li>
                                    <li><a href="#"> Smart Watches</a></li>
                                    <li><a href="#">Tennis</a></li>
                                    <li><a href="#"> Uncategorized</a></li>
                                    <li><a href="#"> Video Games</a></li>
                                    <li><a href="#">Women's</a></li>
                                </ul>
                            </div>
                        </div> {{-- End Single Sidebar Widget --}}

                    </div> {{-- End Sidebar Area --}}
                </div>
                <div class="col-lg-9">
                    {{-- Start Blog Single Content Area --}}
                    <div class="blog-single-wrapper">
                        <x-dynamic-component :component="'blogs.'.$article->frontend_type"
                            :thumbnail="$article->thumbnail" />
                        <ul class="post-meta" data-aos="fade-up" data-aos-delay="200">
                            <li>
                                POSTED BY :
                                <a href="#" class="author">{{ $article->author->name }}</a>
                            </li>
                            <li>
                                ON : <a href="#" class="date">
                                    {{ $article->created_at->diffForHumans() }}
                                </a>
                            </li>
                        </ul>
                        <h4 class="post-title" data-aos="fade-up" data-aos-delay="400">
                            {{ $article->title }}
                        </h4>
                        <div class="para-content" data-aos="fade-up" data-aos-delay="600">
                            {!! $article->content !!}
                        </div>
                        <div class="para-tags" data-aos="fade-up" data-aos-delay="0">
                            <span>Tags: </span>
                            <ul>
                                @foreach ($article->tags as $tag)
                                    <li><a href="{{ route('shop', ['tag' => $tag->slug]) }}">
                                            {{ $tag->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> {{-- End Blog Single Content Area --}}
                    <livewire:products.feedback-component :isArticlePage="true" :article="$article" />
                </div>
            </div>
        </div>
    </div>
</div>

@section('title', 'Article')
