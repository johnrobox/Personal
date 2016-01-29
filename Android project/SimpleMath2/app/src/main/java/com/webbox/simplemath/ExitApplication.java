package com.webbox.simplemath;


import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;

/**
 * Created by su004 on 1/13/2016.
 */
public class ExitApplication extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if( getIntent().getBooleanExtra("Exit me", false)){
            finish();
            return; // add this to prevent from doing unnecessary stuffs
        }
    }
}
