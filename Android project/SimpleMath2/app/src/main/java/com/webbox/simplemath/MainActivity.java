package com.webbox.simplemath;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.content.Intent;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.index_main);

        TextView appHeader = (TextView) findViewById(R.id.titleHeader);
        appHeader.setText("WELCOME TO SIMPLEMATH APP");

        Button startButton = (Button) findViewById(R.id.startButton);
        startButton.setOnClickListener(new View.OnClickListener(){
            public void onClick(View view) {
                Intent i = new Intent(MainActivity.this, QuestionOne.class);
                startActivity(i);
            }
        });

        Button exitButton = (Button) findViewById(R.id.exit);
        exitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent close = new Intent(MainActivity.this, MainActivity.class);
                close.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                close.putExtra("Exit me", true);
                startActivity(close);
                finish();
            }
        });

        if( getIntent().getBooleanExtra("Exit me", false)){
            finish();
            return; // add this to prevent from doing unnecessary stuffs
        }
    }

}
