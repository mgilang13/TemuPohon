package com.example.mgilang13.temupohon;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import android.widget.TextView;

public class Splash extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        TextView tv = (TextView) findViewById(R.id.tv);
        ImageView iv = (ImageView) findViewById(R.id.iv);

        Animation my_animation = AnimationUtils.loadAnimation(this, R.anim.my_transition);
        tv.startAnimation(my_animation);
        iv.startAnimation(my_animation);

        final Intent i = new Intent(this, IntroActivity.class);
        Thread timer = new Thread() {
            @Override
            public void run() {
                try{
                    sleep(5000);
                }
                catch (InterruptedException e) {
                    e.printStackTrace();
                }
                finally {
                    startActivity(i);
                    finish();
                }
            }
        };
        timer.start();
    }
}
