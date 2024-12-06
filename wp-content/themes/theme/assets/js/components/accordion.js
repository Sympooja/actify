class Accordion {
	active_class = 'is_active';
	animation_class = 'is_animated';
	// Supply a $wrapper [accordion]
	constructor($wrapper){
		const _accordion = this;
		this.$wrapper = $wrapper;
		this.$activeItem = false;
		// Bind clicking on [accordion-toggle] to toggle accordion items
		this.$wrapper.find('[accordion-toggle]').on('click', function(){
			_accordion.toggle($(this));
		});
	}
	// Toggle an element and unselect previously active elements
	toggle($el){
		const $parent = this.getParentFromToggle($el);
		if(!$parent) return;
		// Unselect previous item
		if(this.$activeItem && this.$activeItem.index() !== $parent.index()){
			this.$activeItem.removeClass(this.active_class);
			this.$activeItem.removeClass(this.animation_class);
		}
		$parent.toggleClass(this.active_class);
		// Toggle the animation class after a cycle so we can animate from display none
		window.setTimeout(() => {
			$parent.toggleClass(this.animation_class);
		}, 0)
		this.$activeItem = $parent;
	}
	// Get parent [accordion-item] element when toggling child element
	getParentFromToggle($el){
		return $el.closest('[accordion-item]');
	}
}

// Init accordions
$('[accordion]').each(function(){
	new Accordion($(this));
});