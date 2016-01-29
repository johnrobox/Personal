package com.webbox.whoisyourforever;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.TextView;

import org.w3c.dom.Text;

/**
 * Created by su004 on 1/15/2016.
 */
public class PickGender extends AppCompatActivity{


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.pick_gender);

        // male image
        TextView male = (TextView) findViewById(R.id.male);
        male.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent toChoose = new Intent(PickGender.this, ChoosePage.class);
                toChoose.putExtra("iam", "male");
                startActivity(toChoose);
            }
        });

        // female image
        TextView female = (TextView) findViewById(R.id.female);
        female.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent toChoose = new Intent(PickGender.this, ChoosePage.class);
                toChoose.putExtra("iam", "female");
                startActivity(toChoose);
            }
        });


        // back button
        TextView back = (TextView) findViewById(R.id.back);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent back = new Intent(PickGender.this, MainActivity.class);
                startActivity(back);
            }
        });

    }

}
