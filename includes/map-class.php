<?php

class stay22_map_widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'stay22_map_widget', // Base ID
            esc_html__( 'Hotels and Airbnbs Map', 'stay22_map_domain' ), // Name
            array( 'description' => esc_html__( 'This is the description of the widget', 'map_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget']; //Anything that you want to display before the widget

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        //This is the widget content
        echo '<iframe 
        id="stay22-widget" 
        width="'.$instance['width'].'" 
        height="'.$instance['height'].'" 
        frameborder="0"
        src="https://www.stay22.com/embed/gm?address='.urlencode($instance['address']).'&'.$this->formatDate($instance['checkDate']).'&zoom='.$instance['zoom'].'&maincolor='.$this->formatColor($instance['color']).'&'.$this->formatProvider($instance['provider']).'"></iframe>';
        echo $args['after_widget']; //Anything you want to display before the widget
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        //Default value for address
        $address = ! empty( $instance['address'] ) ? $instance['address'] : esc_html__( '917 Mont-Royal Ave E, Montreal, QC H2J 1X3', 'map_domain' );

        //Default value for height
        $height = ! empty( $instance['height'] ) ? $instance['height'] : esc_html__( '465px', 'map_domain' );

        //Default value for width
        $width = ! empty( $instance['width'] ) ? $instance['width'] : esc_html__( '100%', 'map_domain' );

        //Default value for checkDate
        $checkDate = ! empty( $instance['checkDate'] ) ? $instance['checkDate'] : esc_html__( '', 'map_domain' );

        //Default color
        $color = ! empty( $instance['color'] ) ? $instance['color'] : esc_html__( '#2D87FC', 'map_domain' );

        //Default Hotel provider
        $hotel = ! empty( $instance['provider'] ) ? $instance['provider'] : esc_html__( 'Hotels & Airbnb', 'map_domain' );

        ?>

        <!--Address input-->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>">
                <?php esc_attr_e( 'Address:', 'map_domain' ); ?>
            </label>
            <input
                class="widefat address-input"
                id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"
                type="text"
                value="<?php echo esc_attr( $address ); ?>">
        </p>

        <!--Check date input-->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'checkDate' ) ); ?>">
                <?php esc_attr_e( 'Event Dates (MM/DD/YYYY - MM/DD/YYYY):', 'map_domain' ); ?>
            </label><br>
            <input
                placeholder="06/22/2019 - 06/22/2019"
                class="check-date"
                id="<?php echo esc_attr( $this->get_field_id( 'checkDate' ) ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'checkDate' ) ); ?>"
                type="text"
                value="<?php echo esc_attr( $checkDate ); ?>">
        </p>

        <!--Width input-->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>">
                <?php esc_attr_e( 'Width (include px or %):', 'map_domain' ); ?>
            </label>
            <input
                    class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $width ); ?>">
        </p>

        <!--Height input-->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
                <?php esc_attr_e( 'Height (include px or %):', 'map_domain' ); ?>
            </label>
            <input
                    class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $height ); ?>">
        </p>

        <!-- Hotel provider input -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'provider' ) ); ?>">
                <?php esc_attr_e( 'Type of accommodation:', 'map_domain' ); ?>
            </label>

            <select
                    class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'provider' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'provider' ) ); ?>">
                <option value="hotelscombined-airbnb" <?php echo ($hotel == 'hotelscombined-airbnb') ? 'selected' : ''; ?>>
                    Hotels & Airbnb
                </option>

                <option value="hotelscombined" <?php echo ($hotel == 'hotelscombined') ? 'selected' : ''; ?>>
                    Hotels
                </option>

                <option value="airbnb" <?php echo ($hotel == 'airbnb') ? 'selected' : ''; ?>>
                    Airbnb
                </option>
            </select>
        </p>

        <!--Color input-->
       <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>">
                <?php esc_attr_e( 'Color in Hex:', 'map_domain' ); ?>
            </label><br>
            <input
                    class="map-color"
                    id="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $color ); ?>">
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        //Save the title
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        //Save the address
        $instance['address'] = ( ! empty( $new_instance['address'] ) ) ? sanitize_text_field( $new_instance['address'] ) : '';

        //Save Check-in date
        $instance['checkDate'] = ( ! empty( $new_instance['checkDate'] ) ) ? sanitize_text_field( $new_instance['checkDate'] ) : '';

        //Save the color
        $instance['color'] = ( ! empty( $new_instance['color'] ) ) ? sanitize_text_field( $new_instance['color'] ) : '';

        //Save the width
        $instance['width'] = ( ! empty( $new_instance['width'] ) ) ? sanitize_text_field( $new_instance['width'] ) : '';

        //Save the width
        $instance['height'] = ( ! empty( $new_instance['height'] ) ) ? sanitize_text_field( $new_instance['height'] ) : '';

        //Save Provider
        $instance['provider'] = ( ! empty( $new_instance['provider'] ) ) ? sanitize_text_field( $new_instance['provider'] ) : '';

        return $instance;
    }

    /**
     * This function removes the '#' from the string so it can be passed in the url
     *
     * @param $color
     * @return mixed
     */
    private function formatColor($color){
        return str_replace("#","",$color);
    }

    /**
     * This function return a string formatted with the checkin and checkout dates
     *
     * @param $date
     * @return string
     */
    private function formatDate($date){
        $dateArray = explode(" ", $date);
        $formatedDate = 'checkin='.$dateArray[0].'&checkout='.$dateArray[2];
        return $formatedDate;
    }

    /**
     * This function creates a string with the providers boolean
     *
     * @param $provider
     * @return string
     */
    private function formatProvider($provider){
        if(strcasecmp($provider, 'hotelscombined-airbnb') == 0)
            return 'disablehotels=false&disablerentals=false';
        elseif (strcasecmp($provider, 'hotelscombined') == 0)
            return  'disablehotels=false&disablerentals=true';
        else
            return 'disablehotels=true&disablerentals=false';
    }

}