@foreach($messages as $message)
<div class="block block-bordered js-appear-enabled animated fadeIn">
    <div class="row block-header">
        <div class="col-xs-12 col-md-6">
            <a href="#" data-toggle="modal" data-target="#modal-message" data-id="{{$message->id}}"><h3 class="h4 font-w700 text-uppercase mb-5">{{ $message->title }}</h3></a>
        </div>
        <div class="col-xs-12 col-md-6 text-left">
            <div class="text-muted mb-10">
                <span class="mr-5">
                    <i class="fa fa-fw fa-calendar mr-5"></i> {{ humanTiming($message->created_at) }}
                </span>
                <span class="text-muted mr-5">
                    <i class="fa fa-fw fa-user mr-5"></i>הנהלת בית הספר
                </span>
                <span class="text-muted" href="javascript:void(0)">
                    <i class="fa fa-fw fa-tag mr-5"></i>הודעה כללית
                </span>
            </div>
        </div>
    </div>
    <div class="block-content">
    <p>{{texttruncate($message->body, 600)}}</p>
    </div>
    <div class="block-content block-content-full block-content-sm bg-body-light col-md-12">
        <a class="btn btn-primary text-white font-w600" href="javascript:void(0)" id="noticeboard_read" data-toggle="modal" data-target="#modal-message" data-id="{{$message->id}}">קרא עוד...</a>
    </div>
</div>
@endforeach
