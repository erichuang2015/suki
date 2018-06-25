<?php
/**
 * Customizer settings: Footer > Social Links
 *
 * @package Suki
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'suki_section_footer_social';

/**
 * ====================================================
 * Social Links
 * ====================================================
 */

// Heading: Social Links
$wp_customize->add_control( new Suki_Customize_Control_Heading( $wp_customize, 'heading_footer_social', array(
	'section'     => $section,
	'settings'    => array(),
	'label'       => esc_html__( 'Social Links', 'suki' ),
	'description' => '<a href="' . esc_url( add_query_arg( 'autofocus[section]', 'suki_section_social' ) ) . '" class="suki-customize-goto-control button button-default">' . esc_html__( 'Edit Social Media URLs', 'suki' ) . '</a>',
	'priority'    => 10,
) ) );

// ------
$wp_customize->add_control( new Suki_Customize_Control_HR( $wp_customize, 'hr_footer_social', array(
	'section'     => $section,
	'settings'    => array(),
	'priority'    => 10,
) ) );

// Social links
$id = 'footer_social_links';
$wp_customize->add_setting( $id, array(
	'default'     => suki_array_value( $defaults, $id ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'Suki_Customizer_Sanitization', 'multiselect' ),
) );
$wp_customize->add_control( new Suki_Customize_Control_Builder( $wp_customize, $id, array(
	'section'     => $section,
	'label'       => esc_html__( 'Active links', 'suki' ),
	'choices'    => suki_get_social_media_types(),
	'priority'    => 10,
) ) );

// Selective Refresh
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial( 'footer_social_links', array(
		'selector'            => '.suki-footer-social-links',
		'container_inclusive' => true,
		'render_callback'     => 'suki_footer_element__social',
		'fallback_refresh'    => false,
	) );
}

// Social links target
$id = 'footer_social_links_target';
$wp_customize->add_setting( $id, array(
	'default'     => suki_array_value( $defaults, $id ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'Suki_Customizer_Sanitization', 'select' ),
) );
$wp_customize->add_control( $id, array(
	'type'        => 'select',
	'section'     => $section,
	'label'       => esc_html__( 'Open links in', 'suki' ),
	'choices'     => array(
		'self'  => esc_html__( 'Same tab', 'suki' ),
		'blank' => esc_html__( 'New tab', 'suki' ),
	),
	'priority'    => 10,
) );