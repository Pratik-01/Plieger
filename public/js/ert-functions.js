(function ( $ ) {

    // truncate textarea.
    String.prototype.trimToLength = function(m) {
        if (m == undefined) {
            m = 22;
        }
      return (this.length > m) 
        ? jQuery.trim(this).substring(0, m).split(" ").slice(0, -1).join(" ") + "..."
        : this;
    };

}( jQuery ));