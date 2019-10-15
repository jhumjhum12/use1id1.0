<script>

    var alerts = [];
    @foreach(Notification::container()->all() as $notification)
        alerts.push({"type": "{{ $notification->getType() }}", "text": "{{ $notification->getMessage()  }}"});
    @endforeach
</script>

