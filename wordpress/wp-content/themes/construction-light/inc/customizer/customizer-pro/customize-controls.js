(function(api) {

    // Extends our custom "construction-light" section.
    api.sectionConstructor['construction-light'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function() {},

        // Always make the section active.
        isContextuallyActive: function() {
            return true;
        }
    });

})(wp.customize);