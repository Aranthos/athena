{{ ControlGroup::generate(
	Form::label('title', 'Title'),
	Form::text('title',NULL,['placeholder' => 'The title of the page', 'maxlength' => 255]),
	NULL,
	2,
	9
)->withAttributes( ['class' => 'required'] )
}}

{{ ControlGroup::generate(
	Form::label('content', 'Content'),
	Form::textarea('content',NULL,
	[
		'placeholder' => 'The page content, markdown formatting enabled. Tip: use relative links, e.g. [Install Guide](/pages/3) to easily link to other pages in the LANager.',
		'rows' => 10
	]),
	Form::help('<a href="https://daringfireball.net/projects/markdown/basics" target="_blank">Markdown cheatsheet</a>'),
	2,
	9
)
}}

{{ ControlGroup::generate(
	Form::label('parent_id', 'Parent Page'),
	Form::select('parent_id', $pages),
	Form::help('Nest this page below another page'),
	2,
	9
)
}}
{{ ControlGroup::generate(
  Form::label('menu','Menu'),
  Form::text('menu',($title=="Create Page"?"Info":NUll),['placeholder' => 'Name of the menu to file this page under, blank for hidden, \'Info\' for default']),
	Form::help('Sets whether this page is visible in menus and which menu it is in'),
  2,
  9
  )
}}


{{ ControlGroup::generate(
	Form::label('position', 'Position'),
	Form::text('position',NULL,['placeholder' => 'The position of the page in dropdown menus', 'maxlength' => 10]),
	Form::help('This number determines where this item shows in dropdown menus - a higher number means further down the menu'),
	2,
	9
)
}}

<div class="form-group">
	<label for="published" class="control-label col-sm-2">Published</label>
	<div class="checkbox col-sm-9">
		<label>
			{{ Form::hidden( 'published', '0' ) }}
			{{ Form::checkbox( 'published', true, true ) }} Published
		</label>
		{{ Form::help('Sets whether this page is published and therefore visible to everyone') }}
	</div>
</div>

<div class="row">
	<div class="col-md-2 col-md-offset-2">
		{{ Button::normal('Submit')->submit() }}
	</div>
</div>
