@if ($paginator->hasPages())
    <div class="container-fluid container-pagination">
        <div class="container-custom">
            <div class="row">
                <div class="col">
                    <ul class="pagination">
                        @if ($paginator->onFirstPage())
                            <li>
                                <a href="javascript:void(0)" class="btn-next-prev">
                                    <i class="icon fi fi-rr-angle-right"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $paginator->previousPageUrl() }}" class="btn-next-prev">
                                    <i class="icon fi fi-rr-angle-right"></i>
                                </a>
                            </li>
                        @endif
                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li><span>...</span></li>
                            @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li><a href="javascript:void(0)" class="active">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @if ($paginator->hasMorePages())
                            <li>
                                <a href="{{ $paginator->nextPageUrl() }}" class="btn-next-prev">
                                    <i class="icon fi fi-rr-angle-left"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="javascript:void(0)" class="btn-next-prev">
                                    <i class="icon fi fi-rr-angle-left"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
