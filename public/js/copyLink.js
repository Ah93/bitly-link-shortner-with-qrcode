$(document).ready(function () {
    var clipboard = new Clipboard('.btn-copy');
    
    clipboard.on('success', function(event) {
        event.clearSelection();
        event.trigger.textContent = 'Copied';
        window.setTimeout(function() {
            event.trigger.textContent = 'Copy';
        }, 4000);
    });
  });