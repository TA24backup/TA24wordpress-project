<?php
    
function construction_light_starter_content_setup(){

    add_theme_support( 'starter-content', array(
        'attachments' => array(
            'featured-image-home' => array(
                'post_title'   => __( 'Featured Image Homepage', 'construction-light' ),
                'post_content' => __( 'Featured Image Homepage', 'construction-light' ),
                'file'         => 'assets/default/contact.jpg',
            ),
            'featured-slide1'     => array(
                'post_title' => 'First slide',
                'file'       => 'assets/default/slider1.jpg',
            ),
            'featured-slide2'     => array(
                'post_title' => 'Second slide',
                'file'       => 'assets/default/slider2.jpg',
            ),
            'featured-slide2'     => array(
                'post_title' => 'Third slide',
                'file'       => 'assets/default/slider3.jpg',
            ),
            'post-1'              => array(
                'post_title' => 'Landscape',
                'file'       => 'assets/default/default1.jpg',
            )
        ),

        'posts' => array(
            'home'    => require __DIR__ . '/home.php',
            'contact' => require __DIR__ . '/contact.php',
            'services' => require __DIR__ . '/service.php',
            'about' => require __DIR__ . '/about.php',

            'custom_post_1'    => array(
                'post_type'    => 'post',
                'post_title'   => 'Appearance guide',
                'post_content' => '<!-- wp:paragraph -->
                <p>Yet bed any for travelling assistance indulgence unpleasing. Not thoughts all exercise blessing. Indulgence way everything joy alteration boisterous the attachment. Party we years to order allow asked of. We so opinion friends me message as delight. Whole front do of plate heard oh ought. His defective nor convinced residence own. Connection has put impossible own apartments boisterous. At jointure ladyship an insisted so humanity he. Friendly bachelor entrance to on by.</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph -->
                <p>That last is no more than a foot high, and about seven paces across, a mere flat top of a grey rock which smokes like a hot cinder after a shower, and where no man would care to venture a naked sole before sunset. On the Little Isabel an old ragged palm, with a thick bulging trunk rough with spines, a very witch amongst palm trees, rustles a dismal bunch of dead leaves above the<a href="#"> coarse sand</a>.</p>
                <!-- /wp:paragraph -->',
                'thumbnail'    => '{{post-1}}',
            ),
            'custom_post_2'    => array(
                'post_type'    => 'post',
                'post_title'   => 'Perfectly on furniture',
                'post_content' => '<!-- wp:heading {"level":3,"className":"title"} -->
                <h3 class="title">Feet evil to hold long he open knew an no.</h3>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph -->
                <p>Apartments occasional boisterous as solicitude to introduced. Or fifteen covered we enjoyed demesne is in prepare. In stimulated my everything it literature. Greatly explain attempt perhaps in feeling he. House men taste bed not drawn joy. Through enquire however do equally herself at. Greatly way old may you present improve. Wishing the feeling village him musical.</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph -->
                <p>Smile spoke total few great had never their too. Amongst moments do in arrived at my replied. Fat weddings servants but man believed prospect. Companions understood is as especially pianoforte connection introduced. Nay newspaper can sportsman are admitting gentleman belonging his.</p>
                <!-- /wp:paragraph -->',
                'thumbnail'    => '{{post-1}}',
            ),
            'custom_post_3'    => array(
                'post_type'    => 'post',
                'post_title'   => 'Fat son how smiling natural',
                'post_content' => '<!-- wp:paragraph -->
                <p><em>To shewing another demands sentiments. Marianne property cheerful informed at striking at. Clothes parlors however by cottage on. In views it or meant drift to. Be concern parlors settled or do shyness address.&nbsp;</em></p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading -->
                <h2>He always do do former he highly.</h2>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph -->
                <p>Continual so distrusts pronounce by unwilling listening</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:paragraph -->
                <p>Expenses as material breeding insisted building to in. Continual so distrusts pronounce by unwilling listening. Thing do taste on we manor. Him had wound use found hoped. Of distrusts immediate enjoyment curiosity do. Marianne numerous saw thoughts the humoured.</p>
                <!-- /wp:paragraph -->',
                'thumbnail'    => '{{post-1}}',
            ),
            'custom_post_4'    => array(
                'post_type'    => 'post',
                'post_title'   => 'Can curiosity may end shameless explained',
                'post_content' => '<!-- wp:heading -->
                <h2>Way nor furnished sir procuring therefore but.</h2>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph -->
                <p>Warmth far manner myself active are cannot called. Set her half end girl rich met. Me allowance departure an curiosity ye. In no talking address excited it conduct. Husbands debating replying overcame<em>&nbsp;blessing</em>&nbsp;he it me to domestic.</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:list -->
                <ul><li>As absolute is by amounted repeated entirely ye returned.</li><li>These ready timed enjoy might sir yet one since.</li><li>Years drift never if could forty being no.</li></ul>
                <!-- /wp:list -->',
                'thumbnail'    => '{{post-1}}',
            ),
            'custom_post_5'    => array(
                'post_type'    => 'post',
                'post_title'   => 'Improve him believe opinion offered',
                'post_content' => '<!-- wp:paragraph -->
                <p>It acceptance thoroughly my advantages everything as. Are projecting inquietude affronting preference saw who. Marry of am do avoid ample as. Old disposal followed she ignorant desirous two has. Called played entire roused though for one too. He into walk roof made tall cold he. Feelings way likewise addition wandered contempt bed indulged.</p>
                <!-- /wp:paragraph -->
                
                <!-- wp:heading {"level":4} -->
                <h4><strong>Still court no small think death so an wrote.</strong></h4>
                <!-- /wp:heading -->
                
                <!-- wp:paragraph -->
                <p>Incommode necessary no it behaviour convinced distrusts an unfeeling he. Could death since do we hoped is in. Exquisite no my attention extensive. The determine conveying moonlight age. Avoid for see marry sorry child. Sitting so totally forbade hundred to.</p>
                <!-- /wp:paragraph -->',
                'thumbnail'    => '{{post-1}}',
            ),
        ),
        
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
            // Our Custom
            'blogdescription' => 'Just another WordPress site ',
            
        ),

        'theme_mods'  => array(
            'construction_light_enable_frontpage' => true,
            'construction_light_primary_color' => '#ee212b',
            'construction_light_page_sidebar' => 'no',
            
            /** quick contact info for header */
            'construction_light_top_header_enable' => 'disable',
            'construction_light_search_layout' => 'layout_two',
            'construction_light_address' => 'Your Address',
            'construction_light_contact_num' => '0123456789',
            'construction_light_email' => 'example@example.com',
            'construction_light_breadcrumbs_image' => get_template_directory_uri() . '/assets/default/slider2.jpg',

            'construction_light_slider_type' => 'advance',
            'construction_light_sliders' => json_encode( array(
                array(
                    'image' => get_template_directory_uri() . '/assets/default/slider1.jpg',
                    'title' => 'We Build Your Need ',
                    'subtitle' => 'Doloremque voluptate fugiat vero at, quas ut maxime natus, error earum, vel, esse hic facilis cumque…',
                    'button_link' => '#',
                    'button_link_one' => '',
                    'button_text' => esc_html__('Contact Us', 'construction-light'),
                    'button_text_one' => '',
                ),

                array(
                    'image' => get_template_directory_uri() . '/assets/default/slider2.jpg',
                    'title' => 'We Plan Your Future',
                    'subtitle' => 'Doloremque voluptate fugiat vero at, quas ut maxime natus, error earum, vel, esse hic facilis cumque…',
                    'button_link' => '',
                    'button_link_one' => '',
                    'button_text' => esc_html__('Get Quote', 'construction-light'),
                    'button_text_one' => '',
                ),
                array(
                    'image' => get_template_directory_uri() . '/assets/default/slider3.jpg',
                    'title' => 'We Construct Your Dream ',
                    'subtitle' => 'Doloremque voluptate fugiat vero at, quas ut maxime natus, error earum, vel, esse hic facilis cumque…',
                    'button_link' => '#',
                    'button_link_one' => '',
                    'button_text' => esc_html__('Get Quote', 'construction-light'),
                    'button_text_one' => '',
                )
            )),
            
            'construction_light_promoservice_type' => 'advance',
            'construction_light_promoservice_advance' => json_encode( array(
                array(
                    'image' => 'https://demo.sparklewpthemes.com/constructionlight/construction1/wp-content/uploads/sites/17/2021/03/img1.jpg',
					'icon' => 'fas fa-snowflake',
					'title' => 'Shopping Mall',
					'content' => 'Delectus ea, fugiat possimus iste facilis minima dolor consequatur vel voluptas assumenda eum beatae, autem architecto…',
					'link_text' => '',
					'link' => '#'
				),
                array(
                    'image' => 'https://demo.sparklewpthemes.com/constructionlight/construction1/wp-content/uploads/sites/17/2021/03/img1.jpg',
					'icon' => 'fas fa-snowflake',
					'title' => 'Shopping Mall',
					'content' => 'Delectus ea, fugiat possimus iste facilis minima dolor consequatur vel voluptas assumenda eum beatae, autem architecto…',
					'link_text' => '',
					'link' => '#'
				),
                array(
                    'image' => 'https://demo.sparklewpthemes.com/constructionlight/construction1/wp-content/uploads/sites/17/2021/03/img1.jpg',
					'icon' => 'fas fa-snowflake',
					'title' => 'Shopping Mall',
					'content' => 'Delectus ea, fugiat possimus iste facilis minima dolor consequatur vel voluptas assumenda eum beatae, autem architecto…',
					'link_text' => '',
					'link' => '#'
				)
            )),

            'construction_light_aboutus_service_section' => 'disable',
            'construction_light_aboutus' => '{{about}}',

            
            /**
             * Video Call to Action
             */

            'construction_light_video_button_url' => '#',
            'construction_light_video_calltoaction_title' => 'We are Digital Agency & Marketing Expert',
            'construction_light_video_calltoaction_subtitle' => 'More traffic for your agency website?',
            'construction_light_video_calltoaction_image' => get_template_directory_uri() . '/assets/default/interior-five.jpg',

            /** call to action */
            'construction_light_calltoaction_title' => 'Committed to keep people healthy & safe',
            'construction_light_calltoaction_subtitle' => 'We understand that projects represent not only buildings, but the plans for the future of our clients ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperia',
            'construction_light_calltoaction_button' => 'Contact Us',
            'construction_light_calltoaction_link' => '#',
            'construction_light_calltoaction_image' => get_template_directory_uri() . '/assets/default/interior-five.jpg',
            
            'construction_light_portfolio_section' => 'disable',

            /** our service section */
            'construction_light_service_title' => 'Our Best Quality Services',
            'construction_light_service_sub_title' => 'In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus ligula semper metus pellentesque mattis.',
            'construction_light_service_type' => 'advance',
            'construction_light_service_advance' => json_encode(array(
				array(
                    'image' => get_template_directory_uri() . '/assets/default/interior-five.jpg',
					'icon' => 'fas fa-snowflake',
					'title' => 'Office Building',
					'content' => 'In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus ligula semper metus pellentesque mattis.',
					'link_text' => 'Read More',
					'link' => '#',
					'enable' => 'on'
                ),
                array(
                    'image' => get_template_directory_uri() . '/assets/default/interior-five.jpg',
					'icon' => 'fas fa-snowflake',
					'title' => 'Office Building',
					'content' => 'In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus ligula semper metus pellentesque mattis.',
					'link_text' => 'Read More',
					'link' => '#',
					'enable' => 'on'
				),
                array(
                    'image' => get_template_directory_uri() . '/assets/default/interior-five.jpg',
					'icon' => 'fas fa-snowflake',
					'title' => 'Office Building',
					'content' => 'In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus ligula semper metus pellentesque mattis.',
					'link_text' => 'Read More',
					'link' => '#',
					'enable' => 'on'
				)
			)),

            /** counter section */
            'construction_light_counter_section' => 'disable',

            'construction_light_counter_title' => '25 Years Of Experience',
            'construction_light_counter_sub_title' => 'In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus ligula semper metus pellentesque mattis.',
            'construction_light_counter_image' => get_template_directory_uri() . '/assets/default/interior-five.jpg',
            'construction_light_counter' => json_encode(array(
		        array(
		            'counter_icon'  =>'fas fa-wind',
		            'counter_title'  =>'Project Done',
					'counter_number'  =>'2500',	            
					'counter_prefix' => '+',
					'counter_suffix' => ''
				),
				array(
		            'counter_icon'  =>'fas fa-pencil-alt',
		            'counter_title'  =>'Employees',
					'counter_number'  =>'1200',	            
					'counter_prefix' => '+',
					'counter_suffix' => ''
				),
				array(
		            'counter_icon'  =>'fas fa-bolt',
		            'counter_title'  =>'Awards Won',
					'counter_number'  =>'2500',	            
					'counter_prefix' => '+',
					'counter_suffix' => ''
				),
				array(
		            'counter_icon'  =>'fab fa-github-alt',
		            'counter_title'  =>'Happy Clients',
					'counter_number'  =>'3000',	            
					'counter_prefix' => '+',
					'counter_suffix' => ''
				),
            )),


            'construction_light_testimonial_options' => 'disable',
            'construction_light_home_blog_section' => 'disable',
            
            /** clients section */
            'construction_light_client_logo_options' => 'enable',
            'construction_light_client_title' => 'Our Clients',
            'construction_light_client_sub_title' => 'In auctor ex id urna faucibus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In maximus ligula semper metus pellentesque mattis.',
            'construction_light_client' => json_encode(array(
		        array(
		            'client_image' => get_template_directory_uri() . '/assets/default/logo1.png',
		            'client_link'  => '#',
                ),
                array(
		            'client_image' => get_template_directory_uri() . '/assets/default/logo4.png',
		            'client_link'  => '#',
		        ),
                array(
		            'client_image' => get_template_directory_uri() . '/assets/default/logo3.png',
		            'client_link'  => '#',
		        )
		    ))
            
        ),

        'nav_menus' => array(
            'menu-1' => array(
				'name' => __( 'Top Menu', 'construction-light' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
          
                    
					'page_service' => array(
						'type' => 'post_type',
						'object' => 'page',
						'object_id' => '{{services}}',
					),
				),
			),
		),
    ));
}
add_action( 'after_setup_theme', 'construction_light_starter_content_setup' );