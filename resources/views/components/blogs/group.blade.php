@props(['article'])

<div class="col-md-6 col-12 mb-6">
    <div class="blog-list blog-grid-single-item blog-color--golden" data-aos="fade-up" data-aos-delay="0">

        {{ $slot }}

        <div class="content">
            <ul class="post-meta">
                <li>POSTED BY : <a href="#" class="author">{{ $article->author->name }}</a></li>
                <li>ON : <a href="#" class="date">{{ $article->created_at->diffForHumans() }}</a></li>
            </ul>
            <h6 class="title">
                <x-data.link route="article_detail" :value="$article->slug">
                    {{ $article->title }}
                </x-data.link>
            </h6>
            <p>{{ $article->description }}</p>
            <x-data.link class="read-more-btn icon-space-left" route="article_detail" :value="$article->slug">
                Read More <span class="icon"><i class="ion-ios-arrow-thin-right"></i></span>
            </x-data.link>
        </div>
    </div>
</div>
