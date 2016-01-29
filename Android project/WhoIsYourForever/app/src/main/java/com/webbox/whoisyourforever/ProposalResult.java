package com.webbox.whoisyourforever;

import android.app.AlertDialog;
import android.content.ComponentName;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.content.IntentCompat;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.util.Random;

/**
 * Created by su004 on 1/15/2016.
 */
public class ProposalResult extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.proposal_result);

        Intent getValues = getIntent();
        String from = getValues.getStringExtra("from");
        String to = getValues.getStringExtra("to");

        TextView proposalFrom = (TextView) findViewById(R.id.proposalFrom);
        proposalFrom.setText(from);

        TextView proposalTo = (TextView) findViewById(R.id.proposalTo);
        proposalTo.setText(to);


        //Pick a random number for scoring ( 1-Single, 2-Married )
        Random randNumber = new Random();
        int max = 100, min = 1;
        int accepted = randNumber.nextInt((max - min) + 1) + min;
        String result = "";
        result = (accepted > 60)? "Yes" : "No";

        TextView acceptedScore = (TextView) findViewById(R.id.score);
        acceptedScore.setText(""+result+"");


        // if Try Again is click
        Button tryAgain = (Button) findViewById(R.id.tryAgain);
        tryAgain.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent tryOther = new Intent(ProposalResult.this, PickGender.class);
                startActivity(tryOther);
            }
        });

        // if Exit is Click
        Button exitApp = (Button) findViewById(R.id.exitButton);
        exitApp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder alert = new AlertDialog.Builder(ProposalResult.this);
                alert.setTitle("Do you want to Exit?");
                // alert.setMessage("Message");

                alert.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int whichButton) {
                        Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                        ComponentName cn = intent.getComponent();
                        Intent mainIntent = IntentCompat.makeRestartActivityTask(cn);
                        mainIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
                        mainIntent.addFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
                        mainIntent.putExtra("close", true);
                        startActivity(mainIntent);
                        finish();
                    }

                });

                alert.setNegativeButton("Cancel",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int whichButton) {
                            }
                        });

                alert.show();
            }
        });

    }
}
