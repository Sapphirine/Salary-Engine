import data_io
from features import FeatureMapper, SimpleTransform
import numpy as np
import pickle
from sklearn.ensemble import RandomForestRegressor
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.pipeline import Pipeline

def feature_extractor():
    features = [('FullDescription-Bag of Words', 'FullDescription', CountVectorizer(max_features=100)),
                ('Title-Bag of Words', 'Title', CountVectorizer(max_features=100)),
                ('LocationRaw-Bag of Words', 'LocationRaw', CountVectorizer(max_features=100)),
                ('LocationNormalized-Bag of Words', 'LocationNormalized', CountVectorizer(max_features=100))]
    combined = FeatureMapper(features)
    return combined

def get_pipeline():
    features = feature_extractor()
    steps = [("extract_features", features),
             ("classify", RandomForestRegressor(n_estimators=50, #The number of trees in the forest.
                                                verbose=2,#Controls the verbosity of the tree building process.
                                                n_jobs=1,#The number of jobs to run in parallel for both fit and predict.
                                                min_samples_split=30, #The minimum number of samples required to split an internal node.
                                                random_state=3465343  #seed used by the random number generator
                                                ))]
    return Pipeline(steps)

def main():
    print("Reading in the training data")
    train = data_io.get_train_df()

    print("Extracting features and training model")
    classifier = get_pipeline()
    classifier.fit(train, train["SalaryNormalized"])

    print("Saving the classifier")
    data_io.save_model(classifier)
    
if __name__=="__main__":
    main()