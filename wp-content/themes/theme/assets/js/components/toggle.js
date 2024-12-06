class Toggle {
	active_class = 'is_active';
	animation_class = 'is_animated';
	// Supply a $actor [toggle]
	constructor($actor){
		const _toggle = this;
		this.$actor = $actor;
		this.$target = $($actor.attr('toggle'));
		$actor.on('click', function(){
			_toggle.toggle($(this));
		});
	}
	// Toggle an element 
	toggle(){
		this.$target.toggleClass(this.active_class);
		// Toggle the animation class after a cycle so we can animate from display none
		window.setTimeout(() => {
			this.$target.toggleClass(this.animation_class);
		}, 0)
	}
}

// Init toggles
$('[toggle]').each(function(){
	new Toggle($(this));
});