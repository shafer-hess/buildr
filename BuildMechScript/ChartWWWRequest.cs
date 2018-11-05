using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;


public class ChartWWWRequest : MonoBehaviour {
    public Text chartText;
    public InputField inputText;
    private float time = 0.0f;
    public float interpolationPeriod = 1.0f;

    string url = "http://ec2-18-217-185-132.us-east-2.compute.amazonaws.com/";

    // Use this for initialization
    void Start () {
        
    }
	
	// Update is called once per frame
	void Update () {
        time += Time.deltaTime;

        if (time >= interpolationPeriod)
        {
            time = 0;
            Debug.Log("updateChat");
            RefreshChart();
            // execute block of code here
        }
    }

    public void SendMsg()
    {
        StartCoroutine(SendMsgEnum());
    }

    IEnumerator SendMsgEnum()
    {
        WWWForm form = new WWWForm();
        string msg = inputText.text;

        form.AddField("chartMsg", msg);

        using (UnityWebRequest www = UnityWebRequest.Get(url + "addChatMessage.php?message=\n" + msg))
        {
            www.chunkedTransfer = false;
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                // Show results as text
                Debug.Log(www.downloadHandler.text);
                //chartText.text = www.downloadHandler.text;
                //text.GetComponent<Text>().text = www.downloadHandler.text;
                RefreshChart();
            }
        }
    }

    public void RefreshChart()
    {
        StartCoroutine(RefreshChartEnum());
    }

    IEnumerator RefreshChartEnum()
    {
        WWWForm form = new WWWForm();

        using (UnityWebRequest www = UnityWebRequest.Get(url + "getChatMessages.php"))
        {
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                Debug.Log(www.downloadHandler.text);
                chartText.text = www.downloadHandler.text;
            }
        }
    }
}
