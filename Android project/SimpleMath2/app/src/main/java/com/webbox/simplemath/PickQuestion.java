package com.webbox.simplemath;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

import java.net.Inet4Address;

/**
 * Created by su004 on 1/12/2016.
 */
public class PickQuestion extends AppCompatActivity {

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.pick_question_main);

        //for question one
        Button question1 = (Button) findViewById(R.id.question1);
        question1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent questionOne = new Intent(PickQuestion.this, QuestionOne.class);
                startActivity(questionOne);
            }
        });

        //for question two
        Button question2 = (Button) findViewById(R.id.question2);
        question2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent questionTwo = new Intent(PickQuestion.this, QuestionTwo.class);
                startActivity(questionTwo);
            }
        });

        //for question three
        Button question3 = (Button) findViewById(R.id.question3);
        question3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent questionThree = new Intent(PickQuestion.this, QuestionThree.class);
                startActivity(questionThree);
            }
        });

        //for question four
        Button question4 = (Button) findViewById(R.id.question4);
        question4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent questionFour = new Intent(PickQuestion.this, QuestionFour.class);
                startActivity(questionFour);
            }
        });

        //for back
        Button back = (Button) findViewById(R.id.back);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent backPrev = new Intent(PickQuestion.this, QuestionFourSuccess.class);
                startActivity(backPrev);
            }
        });

    }

}
