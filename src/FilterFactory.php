<?php

namespace Inpsyde\Filter;

/**
 * Class FilterFactory
 *
 * @package Inpsyde\Filter
 */
class FilterFactory {

	/**
	 * @var array
	 */
	private $classes = [
		'ArrayValue'                        => ArrayValue::class,
		'DateTime'                          => DateTime::class,
		'WordPress\Absint'                  => WordPress\Absint::class,
		'WordPress\AutoP'                   => WordPress\AutoP::class,
		'WordPress\EscHtml'                 => WordPress\EscHtml::class,
		'WordPress\EscUrlRaw'               => WordPress\EscUrlRaw::class,
		'WordPress\NormalizeWhitespace'     => WordPress\EscHtml::class,
		'WordPress\RemoveAccents'           => WordPress\NormalizeWhitespace::class,
		'WordPress\SanitizeFileName'        => WordPress\SanitizeFileName::class,
		'WordPress\SanitizeKey'             => WordPress\SanitizeKey::class,
		'WordPress\SanitizePostField'       => WordPress\SanitizePostField::class,
		'WordPress\SanitizeTextField'       => WordPress\SanitizeTextField::class,
		'WordPress\SanitizeTitle'           => WordPress\SanitizeTitle::class,
		'WordPress\SanitizeTitleWithDashes' => WordPress\SanitizeTitleWithDashes::class,
		'WordPress\SanitizeUser'            => WordPress\SanitizeUser::class,
		'WordPress\SpecialChars'            => WordPress\SpecialChars::class,
		'WordPress\StripTags'               => WordPress\StripTags::class,
		'WordPress\Unslash'                 => WordPress\Unslash::class,
	];

	/**
	 * Creates and returns a new filter instance of the given type.
	 *
	 * @param       $type
	 * @param array $properties
	 *
	 * @throws \InvalidArgumentException if Filter of given $type is not found.
	 * 
	 * @return FilterInterface
	 */
	public function create( $type, array $properties = [ ] ) {

		$type = (string) $type;

		if ( isset( $this->classes[ $type ] ) ) {
			$class = $this->classes[ $type ];

			return new $class( $properties );
		} else if ( class_exists( $type ) ) {
			$class = new $type( $properties );
			if ( $class instanceof FilterInterface ) {

				return $class;
			}
		}

		throw new \InvalidArgumentException(
			sprintf(
				'The given class <code>%s</code> does not exists.',
				$type
			)
		);

	}
}