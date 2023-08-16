        <div class="footer_wrap ">


                <footer id="footer" class="container">
                    <div class="sub_footer">
                            
                        <p>
                        <?php esc_html_e( 'Copyright © 2022 ', 'shophistic-lite' ); ?><a href="<?php echo esc_url( __( 'https:', 'shophistic-lite' ) ); ?>"><?php esc_html_e( 'Desenvolvido', 'shophistic-lite' ); ?></a>. <?php printf( esc_html__( 'Por %1$s ,  %2$s.', 'shophistic-lite' ), 'SIG, ', '<a href="https:" rel="designer"> Todos os direitos reservados.</a>' ); ?>
                        </p>

                        <?php get_template_part( '/templates/menu', 'social' ); ?>
                           
                        <div class="clearfix"></div>
                    </div><!-- /sub_footer -->
                </footer><!-- /footer -->


            <div class="clearfix"></div>
                
        </div><!-- /footer_wrap -->

        </div><!-- /wrap -->

    
        
    <!-- WP_Footer --> 
    <?php wp_footer(); ?>
    <!-- /WP_Footer --> 

      
    </body>
</html>