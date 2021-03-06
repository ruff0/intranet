@if(!empty($_ENV['slack_url']) && Auth::user()->slack_invite_sent_at)

<div class="ibox">
    <div class="ibox-title">
        <h5>Retrouvez les autres coworkers</h5>
    </div>
    <div class="ibox-content">
        <img src="/img/slack.png" class="img-responsive" />
        <p>Echangez en temps réel avec tous les coworkers!</p>
        <a href="{{$_ENV['slack_url']}}" class="btn btn-primary" target="_blank">Aller sur Slack</a>
    </div>
</div>
@endif