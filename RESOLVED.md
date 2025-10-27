# Drag-and-Drop Fix Explanation

The issue was that the `sortupdate` event listener wasn't firing. The html5sortable library doesn't fire a `sortupdate` event on the document level. Instead, we need to use the `onEnd` callback.

## Solution:
Move the API call logic INSIDE the `onEnd` callback of sortable initialization instead of listening for a separate event.

