window.isPromise = function(p) {
    return p && Object.prototype.toString.call(p) === "[object Promise]";
}
