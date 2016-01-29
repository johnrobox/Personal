package com.webbox.simplemath;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

/**
 * Created by su004 on 1/12/2016.
 */
public class QuestionFourSuccess extends AppCompatActivity{

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.question_success_last);

        final TextView questionSuccess = (TextView) findViewById(R.id.questionSuccess);
        questionSuccess.setText("Excellence! You been completed answering the 4 questions.");

        TextView recup = (TextView) findViewById(R.id.recup);
        recup.setText("Thank you");

        // for pick question
        Button pickQuestion = (Button) findViewById(R.id.pickQuestion);
        pickQuestion.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent toPick = new Intent(QuestionFourSuccess.this, PickQuestion.class);
                startActivity(toPick);
            }
        });

        // for home
        Button home = (Button) findViewById(R.id.home);
        home.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(QuestionFourSuccess.this, MainActivity.class);
                startActivity(i);
            }
        });

        // for repeat
        Button repeatAllQuestions = (Button) findViewById(R.id.repeatAllQuestions);
        repeatAllQuestions.setOnClickListener(new View.OnClickListener() {
            public void onClick(View view){
                Intent repeat = new Intent(QuestionFourSuccess.this, QuestionOne.class);
                startActivity(repeat);
            }
        });

        //for exit
        Button exitApp =  (Button) findViewById(R.id.exitApp);
        exitApp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(QuestionFourSuccess.this, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                intent.putExtra("Exit me", true);
                startActivity(intent);
                finish();
            }
        });

    }
}
