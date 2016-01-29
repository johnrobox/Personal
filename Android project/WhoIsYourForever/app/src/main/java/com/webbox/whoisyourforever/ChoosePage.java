package com.webbox.whoisyourforever;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.TextView;

/**
 * Created by su004 on 1/15/2016.
 */
public class ChoosePage extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        Intent getValues = getIntent();
        String gender = getValues.getStringExtra("iam");

        if (gender.matches("male")) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.choose_main);
            //  button for Marian
            TextView marian = (TextView) findViewById(R.id.marian);
            marian.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent toDescription = new Intent(ChoosePage.this, Description.class);
                    toDescription.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    toDescription.putExtra("Marian", true);
                    toDescription.putExtra("refer", "Marian Rivera");
                    toDescription.putExtra("iam", "male");
                    startActivity(toDescription);
                }
            });

            // button for Angel
            TextView angel = (TextView) findViewById(R.id.angle);
            angel.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent toDescription = new Intent(ChoosePage.this, Description.class);
                    toDescription.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    toDescription.putExtra("Angel", true);
                    toDescription.putExtra("refer", "Angel Locsin");
                    toDescription.putExtra("iam", "male");
                    startActivity(toDescription);
                }
            });

            // button for Ann
            TextView ann = (TextView) findViewById(R.id.ann);
            ann.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent toDescription = new Intent(ChoosePage.this, Description.class);
                    toDescription.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    toDescription.putExtra("Ann", true);
                    toDescription.putExtra("refer", "Anne Curtis");
                    toDescription.putExtra("iam", "male");
                    startActivity(toDescription);
                }
            });

        } else {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.choose_main_boy);
            //  button for Marian
            TextView piolo = (TextView) findViewById(R.id.piolo);
            piolo.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent toDescription = new Intent(ChoosePage.this, Description.class);
                    toDescription.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    toDescription.putExtra("Piolo", true);
                    toDescription.putExtra("refer", "Piolo Pascual");
                    toDescription.putExtra("iam", "female");
                    startActivity(toDescription);
                }
            });

            // button for Angel
            TextView coco = (TextView) findViewById(R.id.coco);
            coco.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent toDescription = new Intent(ChoosePage.this, Description.class);
                    toDescription.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    toDescription.putExtra("Coco", true);
                    toDescription.putExtra("refer", "Coco Martin");
                    toDescription.putExtra("iam", "female");
                    startActivity(toDescription);
                }
            });

            // button for Ann
            TextView robert = (TextView) findViewById(R.id.robert);
            robert.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent toDescription = new Intent(ChoosePage.this, Description.class);
                    toDescription.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    toDescription.putExtra("Robert", true);
                    toDescription.putExtra("refer", "John Robert Jerodiaz");
                    toDescription.putExtra("iam", "female");
                    startActivity(toDescription);
                }
            });


        }


        //back page
        TextView back = (TextView) findViewById(R.id.back);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent backHome = new Intent(ChoosePage.this, PickGender.class);
                startActivity(backHome);
            }
        });


    }
}
