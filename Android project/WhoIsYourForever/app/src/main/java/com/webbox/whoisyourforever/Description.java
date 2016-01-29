package com.webbox.whoisyourforever;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.util.Random;

/**
 * Created by su004 on 1/15/2016.
 */
public class Description extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        //Pick a random number for status ( 1-Single, 2-Married )
        Random randNumber = new Random();
        int max = 2, min = 1;
        int status = randNumber.nextInt((max - min) + 1) + min;
        String selfStatus = (status == 1)? "Single" : "Married";


        super.onCreate(savedInstanceState);

        if (selfStatus.matches("Single")) {
            setContentView(R.layout.single);



            Button proposeButton = (Button) findViewById(R.id.proposeButton);
            proposeButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Intent getValues = getIntent();
                    String proposedTo = getValues.getStringExtra("refer");

                    TextView forError = (TextView) findViewById(R.id.forError);
                    EditText yourName = (EditText) findViewById(R.id.yourName);
                    String fullName = yourName.getText().toString();
                    if (fullName.matches("")) {

                        forError.setText("Please enter your fullname before you submit");
                    } else {

                        String[] arr = fullName.split(" ");
                        StringBuffer sb = new StringBuffer();
                        String capitalizeFirst;

                        for (int i = 0; i < arr.length; i++) {
                            sb.append(Character.toUpperCase(arr[i].charAt(0)))
                                    .append(arr[i].substring(1)).append(" ");
                        }
                        capitalizeFirst = sb.toString().trim();

                        Intent bringData = new Intent(Description.this, ProposalResult.class);
                        bringData.putExtra("from", capitalizeFirst);
                        bringData.putExtra("to", proposedTo);
                        startActivity(bringData);
                    }
                }
            });

        } else {
            setContentView(R.layout.married);
            TextView message = (TextView) findViewById(R.id.message);
            message.setText("Sorry the Person you selected is already married. Please try the other person.");

            Intent getValues = getIntent();
            String gender = getValues.getStringExtra("iam");

            Button tryAgain = (Button) findViewById(R.id.tryAgain);
            if (gender.matches("male")) {
                tryAgain.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent tryAgain = new Intent(Description.this, ChoosePage.class);
                        tryAgain.putExtra("iam", "male");
                        startActivity(tryAgain);
                    }
                });
            } else {
                tryAgain.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent tryAgain = new Intent(Description.this, ChoosePage.class);
                        tryAgain.putExtra("iam", "female");
                        startActivity(tryAgain);
                    }
                });
            }
        }

        TextView artistName = (TextView) findViewById(R.id.artistName);
        TextView aboutHerSelf = (TextView) findViewById(R.id.aboutHerSelf);
        TextView herStatus = (TextView) findViewById(R.id.herStatus);
        TextView selfPicture = (TextView) findViewById(R.id.selfPicture);

        // get current user gender
        Intent getValues = getIntent();
        String gender = getValues.getStringExtra("iam");

        // prepare to remember the user gender
        TextView back = (TextView) findViewById(R.id.back);
        if (gender.matches("male")) {
            back.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent backward = new Intent(Description.this, ChoosePage.class);
                    backward.putExtra("iam", "male");
                    startActivity(backward);
                }
            });
        } else {
            back.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent backward = new Intent(Description.this, ChoosePage.class);
                    backward.putExtra("iam", "female");
                    startActivity(backward);
                }
            });
        }


        if( getIntent().getBooleanExtra("Marian", false)){
            selfPicture.setCompoundDrawablesWithIntrinsicBounds(R.drawable.mariandes, 0, 0, 0);
            artistName.setText("Marian Rivera");
            herStatus.setText("Status : "+selfStatus);
            aboutHerSelf.setText("Marian Rivera Dantes, known professionally as Marian Rivera, is a Spanish-Filipina commercial model and actress, best known for her roles in Marimar, Dyesebel, Amaya, and Temptation of Wife.");

        } else if (getIntent().getBooleanExtra("Angel", false)){
            selfPicture.setCompoundDrawablesWithIntrinsicBounds(R.drawable.angeledes, 0, 0, 0);
            artistName.setText("Angel Locsin");
            herStatus.setText("Status : "+selfStatus);
            aboutHerSelf.setText("Angel Locsin is a Filipina television and film actress, commercial model, film producer and fashion designer.");

        } else if (getIntent().getBooleanExtra("Ann", false)) {
            selfPicture.setCompoundDrawablesWithIntrinsicBounds(R.drawable.annedes, 0, 0, 0);
            artistName.setText("Anne Curtis");
            herStatus.setText("Status : "+selfStatus);
            aboutHerSelf.setText("Anne Ojales Curtis-Smith, also known as Anne Curtis-Smith or simply Anne Curtis, is a Filipino-Australian actress, television host, recording artist, and VJ in the Philippines.");

        } else if (getIntent().getBooleanExtra("Piolo", false)) {
            selfPicture.setCompoundDrawablesWithIntrinsicBounds(R.drawable.piolos, 0, 0, 0);
            artistName.setText("Piolo Pascual");
            herStatus.setText("Status : "+selfStatus);
            aboutHerSelf.setText("Piolo Jose Nonato Pascual is a Filipino film and television actor, musician, model, and producer.");
        } else if (getIntent().getBooleanExtra("Coco", false)) {
            selfPicture.setCompoundDrawablesWithIntrinsicBounds(R.drawable.cocos, 0, 0, 0);
            artistName.setText("Coco Martin");
            herStatus.setText("Status : "+selfStatus);
            aboutHerSelf.setText("Rodel Nacianceno better known by his sreen name Coco Martin, is a Gawad Urian Award-winning Filipino actor. He became famous for starring in independent films, and was dubbed the \"Prince of Philippine Independent Films");
        } else if (getIntent().getBooleanExtra("Robert", false)) {
            selfPicture.setCompoundDrawablesWithIntrinsicBounds(R.drawable.roberts, 0, 0, 0);
            artistName.setText("John Robert");
            herStatus.setText("Status : "+selfStatus);
            aboutHerSelf.setText("John Robert Pahayahay Jerodiaz, better know in office name Roy. A Software programmer someday. hehehehe ! And also the bos of this Android App. (:-");
        } else {
            artistName.setText("Not in choices");
        }

    }
}
